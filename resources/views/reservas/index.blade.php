@extends('adminlte::page')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/crudreservas.css')}}">
<!--     <script src="{{ asset('assets/js/crudreservas.js') }}"></script>
 --></head>
<body>
    <main>
    <form action="{{ route('reservas.pdf') }}" method="get" class="mb-3">
        <label for="start_date">Fecha de inicio:</label>
        <input type="date" name="start_date" required>

        <label for="end_date">Fecha de fin:</label>
        <input type="date" name="end_date" required>

        <button type="submit" class="btn btn-primary">Generar PDF</button>
    </form>
    <div class="imagen" >
        <div class="container py=4">
            <h2>Listado de Reserva</h2>
            <a href="{{('reservas/create')}}" class="botoncrear">Crear nueva reserva</a>
            
        </div>
        <br>
        <table class="table">
            <thead classs="colum">
                <tr >
                    <th id="tr">#id</th>
                    <th id="tr">Fecha</th>
                    <th id="tr">Horario</th>
                    <th id="tr">Cliente</th>
                    <th id="tr">obs</th>
                    <th id="tr">Editar</th>
                    <th id="tr">Eliminar</th>
                    <th id="tr">Cancelar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservas as $reserva)
                <tr class="filas">
                    <td >{{$reserva->id}}</td>
                    <td >{{$reserva->fecha}}</td>
                    <td >{{$reserva->horario->hora}}</td>
                    <td >{{$reserva->user->name}}</td>
                    <td >{{$reserva->obs}}</td>
                    <td >
                        <a href="{{url('reservas/'.$reserva->id.'/edit')}}"class="botonedit" >Editar</a>
                    </td>
                    <td >
                        <form action="{{url('reservas/'.$reserva->id)}}" method="post" 
                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">
                            @method("DELETE")
                            @csrf
                            <button type="submit" class="btneliminar">Eliminar</button>
                        </form>
                    </td>
                    <td >
                        <form action="{{url('reservas/'.$reserva->id.'/cancelar')}}" method="post" 
                            onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta reserva?');">
                            @method("PUT")
                            @csrf
                            <button type="submit" class="btncancelar" {{ $reserva->obs == 'reserva cancelada' ? 'disabled' : '' }}>
                                    {{ $reserva->obs == 'reserva cancelada' ? 'Reserva Cancelada' : 'Cancelar Reserva' }}
                            </button>
                        </form>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    </main>
    
</body>
</html>

@stop