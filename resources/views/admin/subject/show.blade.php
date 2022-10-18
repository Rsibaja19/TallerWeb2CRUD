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
@php
    echo $subject;
@endphp
    <div class="container-sm">
        <div class="container-fluid">
            <h1 class="text-center mt-5 mb-0">{{ $subject_name }}</h1>
            <p class="text-center mb-0">{{ $subject_classroom }}</p>
            <p class="text-center">{{ $schedule }}</p>
            <a href="{{ route('classes.create', $subject) }}" class="btn btn-primary my-4">Matricular Estudiante</a>
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible mt-2 mb-4">
                {{ Session::get('mensaje') }}
            </div>
        @endif
        </div>
        <div class="container-fluid table-responsive">
            <table class="table table-sm table-striped text-center">
                <caption>Listado de estudiantes matriculados</caption>
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->lastname }}</td>
                            <td>
                                @php
                                    $data = $subject_id . '|' . $student->id;
                                @endphp
                                <form action="{{ route('classes.destroy', $data) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Desmatricular</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if (isset($students))
                {{ $students->links() }}
            @endif
        </div>
    </div>
@endsection
