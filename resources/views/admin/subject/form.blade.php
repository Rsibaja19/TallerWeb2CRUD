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

    @if (isset($subject))
        <h1 class="text-center mt-5">Datos de la asignatura</h1>
    @else
        <h1 class="text-center mt-5">Formulario de asignaturas</h1>
    @endif

    @if (isset($subject))
        <form action="{{ route('subject.update', $subject) }}" method="POST" class="row g-4 mt-3">
            @method('PUT')
    @else
        <form action="{{ route('subject.store') }}" method="POST" class="row g-4 mt-3">
    @endif
            @csrf
            <div class="col-md-6">
                <label for="name" class="form-label">Asignatura</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ @old('name') ?? @$subject->name }}">
            @error('name')
                <p class="form-text text-danger mb-0 p-0">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-md-6">
                <label for="classroom" class="form-label">Aula de clases</label>
                <input type="text" class="form-control" name="classroom" id="classroom" value="{{ old('classroom') ?? @$subject->classroom }}">
            @error('classroom')
                <p class="form-text text-danger mb-0 p-0">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-md-12">
                <label for="class_schedule" class="form-label">Horario de clases</label>
                <input type="text" class="form-control" name="class_schedule" id="class_schedule" value="{{ old('class_schedule') ?? @$subject->class_schedule }}">
            @error('class_schedule')
                <p class="form-text text-danger mb-0 p-0">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-md-12">
                <label for="teacher_id" class="form-label">Profesor</label>
                <select class="form-select" name="teacher_id" id="teacher_id" aria-label="select an option">
                @php
                    if (isset($subject)) {
                        echo "<option value='0'>Seleccionar una opción</option>";
                    } else {
                        echo "<option value='0' selected>Seleccionar una opción</option>";
                    }
                @endphp

                @foreach ($teachers as $teacher)
                    @php
                        $name = $teacher->name;
                        $lastname = $teacher->lastname;

                        $fullname = $name . " " . $lastname;

                        if (isset($subject)) {
                            $selected = $teacher->id == $subject->teacher->id ? "selected" : "";
                            echo "<option value='{$teacher->id}' {$selected}>$fullname</option>";
                        } else {
                            echo "<option value='{$teacher->id}'>$fullname</option>";
                        }
                    @endphp
                @endforeach
                </select>
            @error('teacher_id')
                <p class="form-text text-danger mb-0 p-0">{{ $message }}</p>
            @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    @if (isset($subject))
                        Actualizar Asignatura
                    @else
                        Guardar Asignatura
                    @endif
                </button>
            </div>
        </form>
        <div class="d-grid mt-2">
            <a href="{{ route('subject.index') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
@endsection
