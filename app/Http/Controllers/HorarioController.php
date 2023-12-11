<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:Admin.index')->only('index');
        $this->middleware('can:Admin.create')->only('create','store');
        $this->middleware('can:Admin.edit')->only('edit','update');
        $this->middleware('can:Admin.destroy')->only('destroy'); 
    }

    public function index()
    {
        $horarios=Horario::all();
        return view('horarios.index',['horarios'=>$horarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('horarios.create',['horarios'=>Horario::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hora' => 'required|date_format:H:i', // Validar que la hora tenga el formato HH:mm
        ]);
        $horario=new Horario();
        /*  */$horario->id=$request->input('id');
        $horario->hora=$request->input('hora');

        $horario->save();
        return view("horarios.message",['msg' =>"Registro Guardado"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $horario=Horario::find($id);
        return view('horarios.edit',['horario'=>$horario,'horarios'=>Horario::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horario $horario)
    {
        /* $horario= Horario::find($id); */
        $horario->hora=$request->input('hora');
        $horario->save();
        return view("horarios.message",['msg' =>"Registro Modificado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horario $id)
    {
        $horario=Horario::find($id);
        $horario->delete();
        return view("horarios.message",['msg' =>"Registro Eliminado"]);
    }
}
