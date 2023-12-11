<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/crudreservas.css') }}">
    <title>Document</title>
</head>
<body>
    <main>
    <div >
        <div class="container py-4">
            <h2>{{$msg}}</h2>
           <a href="{{url('perfil.edit')}}" class="btn btn-secondary">Regresar</a>
        <div>
    </div>
    </main>
    
</body>
</html>