<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Horario;
use App\Models\User;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Response;
class ReservaClienteController extends Controller
{     
    //si quiere reservar pero no inicio sesion, le lleva directamente a log in
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   

       $horariosDisponibles = Horario::whereNotIn('id', function ($query) {
            $query->select('id')->from('reservas')->where('fecha', '<=', date('Y-m-d'));
        })->get();

        $reservas = Reserva::where('id_user', Auth::id())->get();

        return view('reservasCliente.index', ['reservas' => $reservas, 'horarios' => $horariosDisponibles]);
    }

    public function create(Request $request)
    {
        $fecha = $request->input('fecha');
        $horariosDisponibles = Horario::whereNotIn('id', function ($query) use ($fecha) {
            $query->select('id_horario')->from('reservas')->where('fecha', '=', $fecha);
        })->get();        

        return view('reservasCliente.index', ['horarios' => $horariosDisponibles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'obs' => 'nullable', 
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        if (\Carbon\Carbon::parse($fecha)->dayOfWeek == 0) {
            return redirect()->back()->with('error', 'No se pueden hacer reservas los domingos.');
        }
        
        $reservaExistente = Reserva::where('fecha', $fecha)
            ->where('id_horario', $hora)
            ->first(); 

        if ($reservaExistente) {
            return redirect()->back()->with('error', 'Ya existe una reserva en esa fecha y hora.');
        }

        $reserva = new Reserva();
        $reserva->fecha = $request->input('fecha');
        $reserva->id_horario = $request->input('hora'); 
        $reserva->id_user = Auth::id();
        $reserva->obs = $request->input('obs');

        $reserva->save();
        Session::flash('success', 'Reserva realizada con éxito.');
        return redirect('misreservas');
    }
    public function misReservas()
    {
        
        $reservas = Reserva::where('id_user', Auth::id())->get();
        return view('reservasCliente.reservasclientes', compact('reservas'));
    }
    public function edit($id)
    {
        $reserva = Reserva::find($id);
        $horarios = Horario::all();
        $usuarios = User::all();
        $reservas = Reserva::where('id_user', Auth::id())->get(); // Solo las reservas del usuario autenticado

        return view('reservasCliente.edit', compact('reserva', 'horarios', 'usuarios', 'reservas'));
        /* $reserva=Reserva::find($id);
        //$reserva=Reserva::find($fecha->$id);
        return view('reservasCliente.edit',['reserva'=>$reserva,'horarios'=>Horario::all(),'usuarios'=>User::all(),'reservas'=>Reserva::all()]); */
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'nombre' => 'required',
            'obs' => 'nullable',
        ]);
        $reserva = Reserva::find($id);
        $reserva->fecha = $request->input('fecha');
        $reserva->id_horario = $request->input('hora');
        $reserva->id_user = $request->input('nombre');
        $reserva->obs = $request->input('obs');
    
        $reserva->save();
        return redirect()->route('misreservas')->with('msg', 'Reserva actualizada correctamente');
    }
    public function cancelar($id)
    {
        $reserva = Reserva::findOrFail($id);
        if ($reserva->obs == 'reserva cancelada') {
            return redirect()->back()->with('error', 'La reserva ya está cancelada.');
        } 
        $reserva->obs = 'reserva cancelada';
        $reserva->save();
        return redirect()->route('misreservas')->with('msg', 'reserva cancelada con exito');
    }

}
