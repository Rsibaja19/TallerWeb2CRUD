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
    <div class="container-fluid">
        <div class="container-fluid">
            <h1 class="text-center mt-5">Módulo de gestión de asignaturas</h1>
            <a href="{{ route('subject.create') }}" class="btn btn-primary my-4 px-4">Nueva Asignatura</a>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible mt-2 mb-4">
            {{ Session::get('mensaje') }}
        </div>
    @endif

        </div>
        <div class="container-fluid table-responsive">
            <table class="table table-striped text-center">
                <caption>Listado de asignaturas</caption>
                <thead class="table-dark">
                    <tr>
                        <td>Nombre</td>
                        <td>Aula de clases</td>
                        <td>Horario</td>
                        <td>Profesor</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjects as $subject)
                    @php
                        $name = $subject->teacher->name;
                        $lastname = $subject->teacher->lastname;

                        $fullname = $name . " " . $lastname;
                    @endphp
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->classroom }}</td>
                            <td>{{ $subject->class_schedule }}</td>
                            <td>{{ $fullname }}</td>
                            <td class="d-flex flex-wrap justify-content-center">
                                <a href="{{ route('subject.show', $subject) }}" class="btn btn-info px-2 me-1">Detalles</a>
                                <a href="{{ route('subject.edit', $subject) }}" class="btn btn-warning px-3 ms-1 me-1">Editar</a>
                                <form action="{{ route('subject.destroy', $subject) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger px-2 ms-1"
                                        onclick="return confirm ('¿Desea borrar el registro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No  hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if (isset($subjects))
                {{ $subjects->links() }}
            @endif
        </div>
    </div>
@endsection
