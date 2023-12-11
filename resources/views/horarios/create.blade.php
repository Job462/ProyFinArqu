@extends('adminlte::page')

@section('content')
<link rel="stylesheet" href="{{ asset('css/edithorario.css') }}">
<main class="container py-4">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Insertar Horarios</h2>
        </div>
        <div class="card-body">
            {{-- @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
            <form action="{{url('horarios')}}" method="post" >
                @csrf
                <div class="mb-3 row">
                    <label for="hora" class="col-sm-2 form-label">Hora</label>
                    <div class="col-sm-5">
                            <input type="text" class="form-control" name="hora" id="hora" value='{{old('hora')}}' required>
                            @error('hora')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-5 offset-sm-2">
                        <a href="{{url('horarios')}}" class="btn btn-secondary">Regresar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@stop