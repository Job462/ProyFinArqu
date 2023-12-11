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
            <h2>Formulario de Reserva</h2>
            @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{url('reservas')}}" method="post" id="imgfondo">
            @csrf
            <div class="mb-3 row justify-content-center">
                <label for="fecha" class="col-sm-2 form-check-label">Fecha</label>
                <div class="col-sm-5">
                    <div class="date-input-container">
                        <input type="date" class="form-control" name="fecha" id="fecha" value='{{old('fecha')}}' required>
                        <div class="date-picker-content" id="datePickerContent">Contenido del calendario</div>
                    </div>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="horario" class="col-sm-2 col-form-label">Horario</label>
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
                <label for="cliente" class="col-sm-2 col-form-label">Cliente</label>
                <div class="col-sm-5">
                        <select name="nombre" id="nombre" class="form-select" required>
                            <option value="">Seleccionar Cliente</option>
                            @foreach ($usuarios as $usuario)
                            <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <label for="obs" class="col-sm-2 form-check-label">observacion</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="obs" id="obs" value='obs' required>
               </div>
            </div> 
             <!-- <div class="mb-3 row">
                <label for="obs" class="col-sm-2 col-form-label">observacion</label>
                <div class="col-sm-5">
                    <textarea class="form-control" id="obs" name="obs" rows="4" readonly>{{ $mensaje ?? 'obs' }}</textarea>
                </div>
            </div>  -->

            <div class="text-center">
                <a href="{{url('reservas')}}" class="btn btn-secondary">Regresar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>  
            </div>
        </form>
        </div>
    </div>
    </main>
    
</body>
</html>
@stop