@extends('adminlte::page')

@section('content')
<link rel="stylesheet" href="{{ asset('css/editcliente.css') }}">
<div class="cont1">

    <main class="container py-4">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Insertar Clientes</h2>
            </div>
            <div class="card-body">
                {{-- @if ($errors->any())
                <div class="alert alert-dangerwarning alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
                <form action="{{url('users')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 form-label">Nombre Completo</label>
                        <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" id="name" value='{{old('name')}}' required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fecha_nac" class="col-sm-2 form-label">Fecha de Nacimiento</label>
                        <div class="col-sm-5">
                                <input type="date" class="form-control" name="fecha_nac" id="fecha_nac" value='{{old('fecha_nac')}}' required>
                                @error('fecha_nac')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="celular" class="col-sm-2 form-label">Celular</label>
                        <div class="col-sm-5">
                                <input type="text" class="form-control" name="celular" id="celular" value='{{old('celular')}}' required>
                                @error('celular')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 form-label">Email</label>
                        <div class="col-sm-5">
                                <input type="email" class="form-control" name="email" id="email" value='{{old('email')}}' required>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control"/>
                        @if($errors->has('foto'))
                        <span class="text-danger">{{$errors->first('foto')}}</span>
                        @endif
                        @error('foto')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="mb-3 row">
                        <div class="col-sm-5 offset-sm-2">
                            <a href="{{url('users')}}" class="btn btn-secondary">Regresar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@stop