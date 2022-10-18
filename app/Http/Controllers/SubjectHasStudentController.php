<?php

namespace App\Http\Controllers;

use App\Models\Subject_has_student;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubjectHasStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subject)
    {
        // obtener asignaruras
        $subjects = Subject::all(['id', 'name']);

        // obtener los estudiantes
        $students = Student::all(['id', 'name', 'lastname']);

        // retornar la vista del formulario de matricula
        return view('admin.classes.form')->with([
            'subjects' => $subjects,
            'students' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'subject_id' => 'required',
            'student_id' => 'required'
        ]);

        $enrrole = Subject_has_student::create($request->only([
            'subject_id',
            'student_id'
        ]));

        $subject = Subject::select()->where('id', '=', $enrrole->subject_id)->get()[0];

        // guardar mensaje en la sesión
        Session::flash('mensaje', 'Estudiante matriculado exitosamente.');

        //retornar a la vista del curso
        return redirect()->route('admin.subject.show', $subject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject_has_student  $subject_has_student
     * @return \Illuminate\Http\Response
     */
    public function show(Subject_has_student $subject_has_student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject_has_student  $subject_has_student
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject_has_student $subject_has_student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject_has_student  $subject_has_student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject_has_student $subject_has_student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject_has_student  $student_id $subject_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        // obntener datos de forma individual
        $separador = strpos($data, '|');
        $subject_id = substr($data, 0, $separador);
        $student_id = substr($data, $separador + 1, strlen($data));

        // eliminar registro de la base de datos
        $result = Subject_has_student::where('subject_id', '=', $subject_id)->where('student_id', '=', $student_id)->delete();

        // guardar un mensaje en sesión
        Session::flash('mensaje', 'Registro eliminado satisfactoriamente.');

        // definir la ruda a direccionar
        $route = 'admin/subject/' . $subject_id;
        // redireccionar a la vista vista de mostrar la asignatura
        return redirect($route);
    }
}
