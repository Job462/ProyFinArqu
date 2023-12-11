@extends('adminlte::page')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/crudreservas.css') }}">
    <script src="{{ asset('assets/js/crudreservas.js') }}"></script>
</head>
<body>
    <main>
        <div class="imagen" >
        <div class="container py-4">
            <h2>Editar Reserva</h2>
            @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{url('reservas/'.$reserva->id)}}" method="post" >
            @csrf
            @method('PUT')
    
            <div class="mb-3 row justify-content-center">
                <label for="fecha" class="col-sm-2 form-check-label" id="estilo">Fecha</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" name="fecha" id="fecha" value='{{$reserva->fecha}}' required>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="horario" class="col-sm-2 col-form-label" id="estilo">Horario</label>
                <div class="col-sm-5">
                        <select name="hora" id="hora" class="form-select" required>
                            <option value="">Seleccionar Horario</option>
                            @foreach ($horarios as $horario)
                            <option value="{{$horario->id}}">{{$horario->hora}}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="nombre" class="col-sm-2 col-form-label" id="estilo">Nombre</label>
                <div class="col-sm-5">
                        <select name="nombre" id="nombre" class="form-select" required>
                            <option value="">Seleccionar Cliente</option>
                            @foreach ($usuarios as $usuario)
                            <option value="{{$usuario->id}}">{{$usuario->name}}
                            </option>
                            @endforeach
                        </select>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="obs" class="col-sm-2 form-check-label" id="estilo"> observacion</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="obs" id="obs" value='obs' value='{{$reserva->obs}}'required>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
    <div class="text-center">
        <a href="{{url('reservas')}}" class="btn btn-secondary">Regresar</a>
    </div>
</div>

    </main>
    
</body>
</html>

@stop