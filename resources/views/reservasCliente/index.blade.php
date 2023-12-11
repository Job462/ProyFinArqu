<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva en la Clínica Dental</title>
    <link rel="stylesheet" href="{{ asset('css/reservasCliente.css') }}">
    
</head>
<body>
<div class="container">
    <h1>Reserva de Horario</h1>
    <form method="POST" action="{{ route('reservasCliente.store') }}">
        @csrf
        <div class="mb-3 row justify-content-center">
            <label for="fecha" class="col-sm-2 form-check-label">Seleccione el día</label>
            <div class="col-sm-5">
                <div class="date-input-container">
                    <input type="date" class="form-control" name="fecha" id="fecha" value='{{old('fecha')}}' required>
                    @error('fecha')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3 row justify-content-center">
            <label for="hora" class="col-sm-2 col-form-label">Seleccione la hora:</label>
            <div class="col-sm-5">
                <select name="hora" id="hora" class="form-select" required>
                    <option value="">Seleccionar Horario</option>
                        @foreach ($horarios as $horario)
                            <option value="{{ $horario->id }}">{{ $horario->hora }}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row justify-content-center">
            <label for="cliente" class="col-sm-2 col-form-label">Cliente:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ Auth::user()->name }}" readonly>
            </div>
        </div>
        <div class="mb-3 row justify-content-center">
            <label for="mensaje" class="col-sm-2 form-check-label">Descripcion</label>
            <!-- <label for="mensaje" class="col-sm-2 form-check-label">Mensaje (opcional)</label> -->
            <div class="col-sm-5">
                <textarea class="form-control" name="obs" id="obs">{{ old('obs') }}</textarea>
            </div>
        </div>
        <button type="submit">Reservar</button>
        <a href="{{url('misreservas')}}" class="bton">Atras</a>
>>>>>>>>> Temporary merge branch 2
        <div class="boton">
            <button type="submit">Reservar</button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Cancelar</a> 
        </div>
        <br>
        <div id="alerts-container" style="text-align: center; font-size: 20px; color: white">
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif  
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        

        function showAlert(type, message) {
            var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            var alert = `<div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                            ${message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
            $('#alerts-container').append(alert);
        }
    });
</script>

</body>
</html>
