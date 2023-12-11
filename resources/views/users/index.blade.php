@extends('adminlte::page')

@section('content')
<link rel="stylesheet" href="{{ asset('css/clientecrud.css') }}">

<div class="container">
    <h1 class="mb-4">Lista de Clientes</h1>
    <a href="{{ url('users/create') }}" class="btn btn-primary mb-2">Nuevo Registro</a>
    <a href="{{ route('users.pdf') }}" class="btn btn-primary mb-2">Reporte</a>

    <table class="table table-striped table-bordered">
        <col span="2">
        <thead class="table-light">
            <tr>
                <th>#Id</th>
                <th>Nombre</th>
                <th>Fecha Nac.</th>
                <th>Celular</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->fecha_nac }}</td>
                    <td>{{ $user->celular }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <img src="{{ $user->foto ? asset('storage/images/' . basename($user->foto)) : asset('images/user1.jpg') }}" class="rounded-circle" width="50" height="50"/>
                    </td>
                    <td class="btnop">
                        <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ url('users/' . $user->id) }}" method="post" enctype="multipart/form-data" class="d-inline">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
