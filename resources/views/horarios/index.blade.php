@extends('adminlte::page')

@section('content')
<link rel="stylesheet" href="{{ asset('css/horariocrud.css') }}">

<main class="container py-4">
    <div class="col-lg-8 mb-3">
        <h1>Lista de Horarios</h1>
        <a href="{{ url('horarios/create') }}" class="btn btn-primary btn-sm">Nuevo Registro</a>
    </div>

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>#Id</th>
                <th>Hora</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $horario)
            <tr>
                <td>{{ $horario->id }}</td>
                <td>{{ $horario->hora }}</td>
                <td class="btnop">
                    <a href="{{ url('horarios/' . $horario->id . '/edit') }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ url('horarios/' . $horario->id) }}" method="post" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@stop
