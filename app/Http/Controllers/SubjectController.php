<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Subject_has_student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // definir la paginación
        $subjects = Subject::paginate(5);

        // retornar la vista del index
        return view('admin.subject.index')->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // seleccionar los profesores registrados
        $teachers = Teacher::all(['id', 'name', 'lastname']);

        // retornar la vista del formulario
        return view('admin.subject.form')->with('teachers', $teachers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar los datos que vienen en el request
        $request->validate([
            'name' => 'required|max:75',
            'classroom' => 'required|max:45',
            'class_schedule' => 'required|max:40',
        ]);

        // guardar el registro en la base de datos
        $subject = Subject::create($request->only([
            'name',
            'classroom',
            'class_schedule',
            'teacher_id'
        ]));

        // guardar mensaje en la sesión
        Session::flash('mensaje', 'Asignatura registrada exitosamente.');

        // redireccionar a la vista del index
        return redirect()->route('subject.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        // obtener los estudiantes matriculados en la asignatura
        $students = Subject_has_student::join('students', 'students.id', 'subject_has_students.student_id')
        ->select(['students.id', 'name', 'lastname'])
        ->where('subject_id', '=', $subject->id)->paginate(5);

        //echo $subject;

        $details = [
            'subject_id' => $subject->id,
            'subject_name' => $subject->name,
            'subject_classroom' => $subject->classroom,
            'schedule' => $subject->class_schedule,
            'students' => $students,
            'subject' => $subject
        ];

        // retornar la vista show
        return view('admin.subject.show')->with($details);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        // seleccionar los profesores registrados
        $teachers = Teacher::all(['id', 'name', 'lastname']);

        // retornar la vista del formulario
        return view('admin.subject.form')->with(['subject' => $subject, 'teachers' => $teachers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        // validar los campos que vienen en la petición
        $request->validate([
            'name' => 'required|max:75',
            'classroom' => 'required|max:45',
            'class_schedule' => 'required|max:40',
            'teacher_id' => 'required'
        ]);

        // asignar valores al objeto subject
        $subject->name = $request->name;
        $subject->classroom = $request->classroom;
        $subject->class_schedule = $request->class_schedule;
        $subject->teacher_id = $request->teacher_id;

        // guardar registro en la base de datos
        $subject->save();

        // guardar mensaje en la sesión
        Session::flash('mensaje', 'Los datos de la asignatura han sido actualizados.');

        // redireccionar a la vista del index
        return redirect()->route('subject.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        // eliminar el registro
        $subject->delete();

        // guardar mensaje en la sesión
        Session::flash('mensaje', 'Registro eliminado satisfactoriamente.');

        // redireccionar a la vista del index
        return redirect()->route('subject.index');
    }
}
