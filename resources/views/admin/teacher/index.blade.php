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
            <h1 class="text-center mt-5">Módulo de gestión de profesores</h1>
            <a href="{{ route('teacher.create') }}" class="btn btn-primary my-4 px-4">Nuevo Profesor</a>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible mt-2 mb-4">
            {{ Session::get('mensaje') }}
        </div>
    @endif
        </div>
        <div class="container-fluid table-responsive">
            <table class="table table-striped text-center">
                <caption>Listado de profesores</caption>
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Salario</th>
                        <th>Acciones</th>
                    </tr>
                <tbody>
                    @forelse ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->lastname }}</td>
                            <td>{{ $teacher->dni }}</td>
                            <td>{{ $teacher->address }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->salary }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('teacher.edit', $teacher) }}" class="btn btn-warning px-3 me-1">Editar</a>
                                    <form action="{{ route('teacher.destroy', $teacher) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger px-2 ms-1"
                                            onclick="return confirm ('¿Desea borrar el registro?')">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
                </thead>
            </table>
            @if (isset($teachers))
                {{ $teachers->links() }}
            @endif
        </div>
    </div>
@endsection
