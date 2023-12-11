<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Reservas de la Clínica</title>
    <style>
        *{
            text-align: center;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black; 
            padding: 8px;
        }

    </style>
</head>

<body>
    <h2>REPORTE DE RESERVAS EN PDF</h2>

    <p>Fecha de inicio: {{ $start_date }}</p>
    <p>Fecha de fin: {{ $end_date }}</p>

    <table>
        <thead>
            <tr>
                <td>#Id</td>
                <td>Fecha</td>
                <td>Hora</td>
                <td>Nombre</td>
                <td>Mensaje</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->id }}</td>
                    <td>{{ $reserva->fecha }}</td>
                    <td>{{ $reserva->horario->hora }}</td>
                    <td>{{ $reserva->user->name }}</td>
                    <td>{{ $reserva->obs }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>


</html>
