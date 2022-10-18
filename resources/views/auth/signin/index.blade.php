@extends('theme.base')

@section('nav')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">Escuela</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('welcome') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('login.show') }}">Entrar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-11 col-md-8 mx-auto text-center">
                <h1 class="text-center my-0">Bienvenido, inicia sesión 👋</h1>
                <small class="text-secondary">Administrar tu colegio nunca fue tan facil 😉</small>
            </div> 
        </div>
        <div class="row mt-3">
            <form 
                action="{{ route('login.perform') }}" 
                method="POST" 
                class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto"
            >
                @csrf
                
                @if (Session::has('mensaje'))
                    <div class="alert alert-danger alert-dismissible my-2">
                        {{ Session::get('mensaje') }}
                    </div>
                @endif

                @if (Session::has('registered'))
                    <div class="alert alert-success alert-dismissible mt-2 mb-2">
                        {{ Session::get('registered') }}
                    </div>
                @endif    

                <div class="row mt-2">
                    <div class="col mx-auto">
                        <div class="form-group">
                            <label for="email" class="form-label"><b>Correo Electrónico</b></label>
                            <input type="email" name="email" id="email" class="form-control">                            
                        </div>
                        @error('email')
                            <small class="form-text text-muted text-danger">{{ $message }}</small>                                          
                        @enderror
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col mx-auto">
                        <div class="form-group">
                            <label for="email" class="form-label"><b>Contraseña</b></label>
                            <input type="password" name="password" id="password" class="form-control">                            
                        </div>
                        @error('email')
                            <small class="form-text text-muted text-danger">{{ $message }}</small>                                          
                        @enderror
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-11 col-sm-10 col-md-8 col-lg-6 mx-auto">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    <span class="mr-2">¿Aún no tienes cuenta 🤔?</span>&nbsp;<a href="{{ route('signup.index') }}">Registrate aquí.</a>
                </div>

            </form>
        </div>
    </div>
@endsection
