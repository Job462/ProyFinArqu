<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Clientes de la Clínica</title>
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
    <h2>REPORTE DE CLIENTES EN PDF</h2>

    <table>
        <thead>
            <tr>
                <th>#Id</th>
                <th>Nombre</th>
                <th>Fecha de Nacimiento</th>
                <th>Celular</th>
                <th>Email</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
