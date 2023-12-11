<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use App\Models\Reserva;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
        $users=User::all();//
        return view('users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create',['users'=>User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/|max:255',
            'email' => 'required|email',
            'fecha_nac' => 'date|before_or_equal:today',
            'celular' => 'numeric|min:7',
            'foto' => 'image|mimes:jpeg,jpg,gif,png|max:10000',
        ]);

        /* $imageName = $request->hasFile('foto')
        ? $request->file('foto')->store('public/images')
        : 'images/user1.jpg';  */
        // Establecer la imagen predeterminada
        $defaultImage = 'images/user1.jpg';

        $imageName = $request->hasFile('foto')
            ? $request->file('foto')->store('public/images')
            : $defaultImage;

        $cliente=new User();
        $cliente->name=$request->input('name');
        $cliente->fecha_nac=$request->input('fecha_nac');
        $cliente->celular=$request->input('celular');
        $cliente->email=$request->input('email');
        $cliente->foto=$imageName;
        $cliente->save();

        return view("users.message",['msg' =>"Registro Guardado"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente=User::find($id);
        return view('users.edit',['user'=>$cliente,'horarios'=>Horario::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/|max:255',
            'email' => 'required|email',
            'fecha_nac' => 'date|before_or_equal:today',
            'celular' => 'numeric|min:7',
            'foto' => 'image|mimes:jpeg,jpg,gif,png|max:10000',
        ]);

        /* $imageName = $request->hasFile('foto')
        ? $request->file('foto')->store('public/images')
        : 'images/user1.jpg';  */
        // Establecer la imagen predeterminada
        $defaultImage = 'images/user1.jpg';

        $imageName = $request->hasFile('foto')
            ? $request->file('foto')->store('public/images')
            : $defaultImage;
        
        $cliente= User::find($id);
        $cliente->name=$request->input('name');
        $cliente->fecha_nac=$request->input('fecha_nac');
        $cliente->celular=$request->input('celular');
        $cliente->email=$request->input('email');
        $cliente->foto=$imageName;
        $cliente->save();
        return view("users.message",['msg' =>"Registro Modificado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Reserva::where('id_user',$id)->delete();
        $cliente=User::find($id);
        $cliente->delete();
        return view("users.message",['msg' =>"Registro Eliminado"]);
    }

    public function pdf(){
        $users = User::all();
        $pdf=Pdf::loadView('users.pdf',\compact('users'));
        return $pdf->stream();
        /* return view('users.pdf'); */
    }
    
}
