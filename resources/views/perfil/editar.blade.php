


    <link rel="stylesheet" href="{{ asset('css/editcliente.css') }}">
    <main class="container py-4">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Editar Perfil</h2>
            </div>
            <div class="card-body">
        {{--  @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
            <form action="{{ route('perfil.actualizar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 form-label">Nombre Completo</label>
                        <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" id="name" value='{{$user->name}}' required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fecha_nac" class="col-sm-2 form-label">Fecha de Nacimiento</label>
                        <div class="col-sm-5">
                                <input type="date" class="form-control" name="fecha_nac" id="fecha_nac" value='{{$user->fecha_nac}}' required>
                                @error('fecha_nac')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="celular" class="col-sm-2 form-label">Celular</label>
                        <div class="col-sm-5">
                                <input type="text" class="form-control" name="celular" id="celular" value='{{$user->celular}}' required>
                                @error('celular')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 form-label">Email</label>
                        <div class="col-sm-5">
                                <input type="email" class="form-control" name="email" id="email" value='{{$user->email}}' required>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="current_password" class="col-sm-2 form-label">Contraseña Actual</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" name="current_password" id="current_password" required>
                            @error('current_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="new_password" class="col-sm-2 form-label">Nueva Contraseña</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" name="new_password" id="new_password" minlength="8" required>
                            @error('new_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="new_password_confirmation" class="col-sm-2 form-label">Confirmar Nueva Contraseña</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" minlength="8" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Foto</label><br>
                        <input type="file" name="foto" class="form-control"/>
                        @if($errors->has('foto'))
                        <span class="text-danger">{{$errors->first('foto')}}</span>
                        @endif
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-5 offset-sm-2">
                            <a href="{{url('/')}}" class="btn btn-secondary">Regresar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
