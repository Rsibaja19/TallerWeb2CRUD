@extends('theme.base')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center mt-5">Formulario de matricula</h1>
        <form action="{{ route('classes.store') }} " method="POST" class="row g-3 mt-3">
            @csrf
            <div class="col-md-6 offset-md-3">
                <label for="subject_id" class="form-label">Asignatura</label>
                <select name="subject_id" id="subject_id" class="form-select">
                @php
                    if (isset($subjects)) {
                        echo "<option value='0'>Seleccionar una opción</option>";
                    } else {
                        echo "<option value='0' selected>Seleccionar una opción</option>";
                    }
                @endphp

                @foreach ($subjects as $subject)
                    @php
                        $name = $subject->name;
                        echo "<option value='{$subject->id}'>$name</option>";
                    @endphp
                @endforeach
                </select>
            </div>
            <div class="col-md-6 offset-md-3">
                <label for="student_id" class="form-label">Estudiante</label>
                <select name="student_id" id="student_id" class="form-select">
                @php
                    if (isset($students)) {
                        echo "<option value='0'>Seleccionar una opción</option>";
                    } else {
                        echo "<option value='0' selected>Seleccionar una opción</option>";
                    }
                @endphp

                @foreach ($students as $student)
                    @php
                        $name = $student->name;
                        $lastname = $student->lastname;

                        $fullname = $name . " " . $lastname;
                        echo "<option value='{$student->id}'>$fullname</option>";
                    @endphp
                @endforeach
                </select>
            </div>
            <div class="col-md-6 offset-md-3 d-grid">
                <button type="submit" class="btn btn-primary">Matricular Estudiante</button>
            </div>
        </form>
        <div class="col-md-6 offset-md-3 d-grid mt-2">
            <a href="{{ route('subject.index') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
@endsection
