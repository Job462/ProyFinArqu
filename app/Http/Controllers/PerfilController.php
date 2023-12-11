<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PerfilController extends Controller
{
    public function edit(User $user)
    {
        $user = Auth::user();
        return view('perfil.editar', compact('user'));
    }

    
    public function update(Request $request)
    {
        $id = auth()->user()->id;
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/|max:255',
            'email' => 'required|email',
            'fecha_nac' => 'date|before_or_equal:today',
            'celular' => 'numeric|min:7',
            'foto' => 'image|mimes:jpeg,jpg,gif,png|max:10000',
            'current_password' => 'required|password',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $defaultImage = 'images/user1.jpg';

        $imageName = $request->hasFile('foto')
            ? $request->file('foto')->store('public/images')
            : $defaultImage;
        
        $cliente= User::find($id);
        $cliente->name=$request->input('name');
        $cliente->fecha_nac=$request->input('fecha_nac');
        $cliente->celular=$request->input('celular');
        $cliente->email=$request->input('email');
        if ($request->has('new_password')) {
            $cliente->password = bcrypt($request->input('new_password'));
        }
        $cliente->foto=$imageName;
        $cliente->save();
        return redirect()->route('perfil.editar')->with('succes', 'Reserva actualizada correctamente');
    }
}
