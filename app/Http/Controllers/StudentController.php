<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // crear paginación
        $students = Student::paginate(5);

        // retornar la vista del index de estudiantes
        return view('admin.student.index')
                ->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // retornar la vista del formulario de estudiantes
        return view('admin.student.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar datos que vienen en el request
        $request->validate([
            'name' => 'required|max:75',
            'lastname' => 'required|max:75',
            'email' => 'required|max:100',
            'dni' => "required|max:15",
            'phone' => 'required|max:15',
            'address' => 'required|max:100',
            'level' => 'required|max:1'
        ]);

        // almacenar registro en la base de datos
        $student = Student::create($request->only([
            'name',
            'lastname',
            'email',
            'dni',
            'phone',
            'address',
            'level'
        ]));

        // guardar mensaje en la sesión
        Session::flash('mensaje', 'Estudiante registrado exitosamente.');

        // redireccionar a la vista del index de estudiantes
        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        // obtentener los niveles

        // retornar a la vista del formulario y enviarle el objeto estudiante
        return view('admin.student.form')->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // validar datos que vienen en el request
        $request->validate([
            'name' => 'required|max:75',
            'lastname' => 'required|max:75',
            'email' => 'required|max:100',
            'dni' => "required|max:15",
            'phone' => 'required|max:15',
            'address' => 'required|max:100',
            'level' => 'required|max:1'
        ]);

        // asignar datos al objeto estudiante
        $student->name = $request->name;
        $student->lastname = $request->lastname;
        $student->email = $request->email;
        $student->dni = $request->dni;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->level = $request->level;

        // guardar en la base de datos
        $student->save();

        // guardar un mensaje en la sesión
        Session::flash('mensaje', 'Los datos del estudiante han sido actualizados.');

        // redireccionar a la vista del index de estudiantes
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        // eliminar registro de la base de datos
        $student->delete();

        // guardar mensaje en la sesión
        Session::flash('mensaje', 'Registro eliminado satisfactoriamente.');

        // redirigir a la vista del index de estudiantes
        return redirect()->route('student.index');
    }
}
