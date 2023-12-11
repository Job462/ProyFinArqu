<link rel="stylesheet" href="{{ asset('css/reservasCliente.css') }}">
<style>
        table{
            text-align: center;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: none; 
        }
        .sticky {
            position: sticky;
            top: 80px; 
            text-align: center;
            background-color: #f1f1f1;
            padding: 20px;
            z-index: 900; 
        }

        .sticky1 {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            padding: 10px;
            text-align: center;
            z-index: 1000;
            background: linear-gradient(180deg, rgba(205,222,227,1) 0%, rgba(175,193,213,1) 25%, rgba(128,147,157,1) 50%, rgba(94,125,172,1) 75%, rgba(85,108,139,1) 100%);
        }
        .table th{
            background: linear-gradient(180deg, rgba(205,222,227,1) 0%, rgba(175,193,213,1) 25%, rgba(128,147,157,1) 50%, rgba(94,125,172,1) 75%, rgba(85,108,139,1) 100%);
            color: white;
            padding: 10px;
            border: none;
        }
        .btneliminar {
            background-color: #ff6347;
            border: 0;
            color: white;
        }
        .btneliminar:hover {
            background-color: #d9534f;
        }

        
        
    </style>
    <div class="container py-4">
    <h2>Mis Reservas</h2>
    <div class="sticky1">
        <a href="{{ route('reservasCliente.index') }}" class="bton">CREAR RESERVA</a>
        <a href="{{ url('/') }}" class="bton">Regresar</a>
    </div>
    <table  >
        <thead class="table" >
            <tr class="sticky">
                <th>#id</th>
                <th>Fecha</th>
                <th>Horario</th>
                <th>Observaciones</th>
                <th>Editar</th>
                <th>Cancelar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservas->where('obs', '!=', 'reserva cancelada') as $reserva)
                <tr>
                    <td>{{ $reserva->id }}</td>
                    <td>{{ $reserva->fecha }}</td>
                    <td>{{ $reserva->horario->hora }}</td>
                    <td>{{ $reserva->obs }}</td>
                    <td>
                        <a href="{{ url('reservasCliente/'.$reserva->id.'/edit') }}" class="bton">Editar</a>
                    </td>
                    <td>
                        <form action="{{ url('reservasCliente/'.$reserva->id.'/cancelar') }}" method="post" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta reserva?');">
                            @method("PUT")
                            @csrf
                            <button type="submit" style="background-color: #ff6347;" {{ $reserva->obs == 'reserva cancelada' ? 'disabled' : '' }}>
                                {{ $reserva->obs == 'reserva cancelada' ? 'Reserva Cancelada' : 'Cancelar Reserva' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No tienes reservas registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
