<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Admin.index')->only('index');
        $this->middleware('can:Admin.destroy')->only('destroy'); 
    }
    public function index()
    {
        $reservas=Reserva::all();//
        return view('reservas.index',['reservas'=>$reservas]);
    }

    public function create()
    {
        $horariosDisponibles = Horario::all(); /* Horario::whereNotIn('id', function($query) {
            $query->select('id')->from('reservas')->where('fecha', '<=', date('Y-m-d'));
        })->get(); */
        
        return view('reservas.create', ['horarios' => $horariosDisponibles, 'usuarios' => User::all()]);

    }

    public function store(Request $request)
    {       
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today', // Asegúrate de que la fecha sea una fecha válida
            'hora' => 'required',
            'nombre' => 'required',
            'obs' => 'nullable', // Si 'obs' es opcional
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        
        if (\Carbon\Carbon::parse($fecha)->dayOfWeek == 0) {
            return view("reservas.message", ['msg' => "No se pueden hacer reservas los domingos."]);
        }
        // Verificar si la hora ya está reservada en la fecha seleccionada
        $reservaExistente = Reserva::where('fecha', $fecha)
            ->where('id_horario', $hora)
            ->first(); 
        if ($reservaExistente) {
            return view("reservas.message", ['msg' => "error ya existe una reserva en esa fecha y hora"]);
        }
        // Crear una nueva instancia de Reserva
        $reserva = new Reserva();
        $reserva->fecha = $fecha;
        $reserva->id_horario = $hora;
        $reserva->id_user = $request->input('nombre');
        $reserva->obs = "reserva exitosa";

        // Guardar la nueva reserva
        $reserva->save();
    
        return view("reservas.message", ['msg' => "Registro Guardado"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reserva=Reserva::find($id);
        //$reserva=Reserva::find($fecha->$id);
        return view('reservas.edit',['reserva'=>$reserva,'horarios'=>Horario::all(),'usuarios'=>User::all(),'reservas'=>Reserva::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today', // Asegúrate de que la fecha sea una fecha válida
            'hora' => 'required',
            'nombre' => 'required',
            'obs' => 'nullable', // Si 'obs' es opcional
        ]);
        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        
        $reservasPorDia = Reserva::where('fecha', $fecha)
        ->where('id_user', $request->input('nombre'))
        ->count();

        if ($reservasPorDia >= 3) {
            $mensaje = "Solo puedes hacer un máximo de 3 reservas por día. Seleccione otro dia 😁";
            return back()->withErrors([$mensaje]);
        }
        
        if (\Carbon\Carbon::parse($fecha)->dayOfWeek == 0) {
            $mensaje = "No se pueden hacer reservas los domingos.";
            return back()->withErrors([$mensaje]);
        }
        // Verificar si la hora ya está reservada en la fecha seleccionada
        $reservaExistente = Reserva::where('fecha', $fecha)
            ->where('id_horario', $hora)
            ->first(); 
        if ($reservaExistente) {
            $mensaje = "ya existe una reserva en ese horario y fecha.";
            return back()->withErrors([$mensaje]);
        }

        /* $reserva= Reserva::find($id); */
        $reserva->fecha=$request->input('fecha');
        $reserva->id_horario=$request->input('hora');
        $reserva->id_user=$request->input('nombre');
        $reserva->obs=$request->input('obs');

        $reserva->save();
        
        return view("reservas.message",['msg' =>"Registro Modificado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $reserva=Reserva::find($id);
        $reserva->delete();
        return view("reservas.message",['msg' =>"Registro Eliminado"]);
    }

    public function pdf(Request $request){

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        $reservas = Reserva::whereBetween('fecha', [$start_date, $end_date])->get();
    
        $pdf = PDF::loadView('reservas.pdf', compact('reservas', 'start_date', 'end_date'));
    
        return $pdf->stream('reporte_reservas.pdf');
    }
    public function cancelar($id)
    {
        $reserva = Reserva::findOrFail($id);
        /* if ($reserva->obs == 'reserva cancelada') {
            return redirect()->back()->with('error', 'La reserva ya está cancelada.');
        } */
        $reserva->obs = 'reserva cancelada';
        $reserva->save();
        return redirect()->back()->with('msg', 'Reserva cancelada correctamente.');
    }
}
