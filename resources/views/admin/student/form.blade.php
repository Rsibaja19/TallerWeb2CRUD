@extends('theme.base')

@section('nav')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.home') }}">Escuela</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('admin.home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('student.index') }}">Estudiantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teacher.index') }}">Profesores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('subject.index') }}">Asignaturas</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="btn btn-danger" role="button" href="{{ route('logout.perform') }}">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container-sm">

    @if (isset($student))
        <h1 class="text-center mt-5">Datos del estudiante</h1>
    @else
        <h1 class="text-center mt-5">Registro de estudiantes</h1>
    @endif

    @if (isset($student))
        <form action="{{ route('student.update', $student) }}" method="POST" class="row g-3 mt-3">
            @method('PUT')
    @else
        <form action="{{ route('student.store') }}" method="POST" class="row g-3 mt-3">
    @endif
            @csrf
            <div class="col-md-6">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" id="name"
                    value="{{ old('name') ?? @$student->name }}">
            @error('name')
                <p class="form-text text-danger mb-0 p-0">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-md-6">
                <label for="lastname" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="lastname" id="lastname"
                    value="{{ old('lastname') ?? @$student->lastname }}">
            @error('lastname')
                <p class="form-text text-danger mb-0 p-0"">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-12">
                <label for="email" class="form-label">Correo</label>
                <input type="text" class="form-control" name="email" id="email"
                    value="{{ old('email') ?? @$student->email }}">
            @error('email')
                <p class="form-text text-danger mb-0 p-0"">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-md-6">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" id="dni"
                    value="{{ old('dni') ?? @$student->dni }}">
            @error('dni')
                <p class="form-text text-danger mb-0 p-0"">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="phone" id="phone"
                    value="{{ old('phone') ?? @$student->phone }}">
            @error('phone')
                <p class="form-text text-danger mb-0 p-0"">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-12">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Cra. 20 #28 - 50"
                    value="{{ old('address') ?? @$student->address }}">
            @error('address')
                <p class="form-text text-danger mb-0 p-0"">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-12">
                <label for="level" class="form-label">Nivel escolar</label>
                <select class="form-select" name="level" id="level" aria-label="select an option">
            @php

                if (isset($student)) {
                    echo "<option value='0'>Seleccionar una opción</option>";
                } else {
                    echo "<option value='0' selected>Seleccionar una opción</option>";
                }

                $options = [
                    '<option value=\'1\' selected>Primero</option>',
                    '<option value=\'2\' selected>Segundo</option>',
                    '<option value=\'3\' selected>Tercero</option>',
                    '<option value=\'4\' selected>Cuarto</option>',
                    '<option value=\'5\' selected>Quinto</option>'
                ];

                $values = [
                    'Primero',
                    'Segundo',
                    'Tercero',
                    'Cuarto',
                    'Quinto'
                ];

                $level = old('level') ?? @$student->level;

                for ($i=1; $i <= sizeof($options); $i++) {
                    if ($level == $i) {
                        echo $options[$i - 1];
                    } else {
                        echo "<option value='" . "{$i}" .'\'>' . $values[$i - 1] . '</option>';
                    }
                }
            @endphp
                </select>
            @error('level')
                <p class="form-text text-danger mb-0 p-0"">{{ $message }}</p>
            @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary p-2">
                @if (isset($student))
                    Actualizar Registro
                @else
                    Guardar Registro
                @endif
                </button>
            </div>
        </form>
        <div class="d-grid mt-2">
            <a href="{{ route('student.index') }}" class="btn btn-danger p-2">Cancelar</a>
        </div>
    </div>
@endsection
