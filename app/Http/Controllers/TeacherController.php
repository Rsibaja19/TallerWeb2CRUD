<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teachers = Teacher::paginate(5);
        return view('admin.teacher.index')->with('teachers', $teachers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar datos que vienen en la petición
        $request->validate([
            'name' => 'required|max:75',
            'lastname' => 'required|max:75',
            'dni' => 'required|max:15',
            'address' => 'required|max:100',
            'phone' => 'required|max:15',
            'email' => 'required|max:100',
            'salary' => 'required'
        ]);

        // guardar registro
        $teacher = Teacher::create($request->only([
            'name',
            'lastname',
            'dni',
            'address',
            'phone',
            'email',
            'salary'
        ]));

        // guardar mensaje en la sesión
        Session::flash('mensaje', 'Profesor registrado exitosamente.');

        //retornar a la vista del index
        return redirect()->route('teacher.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        // retornar la vista del formulario
        return view('admin.teacher.form')->with('teacher', $teacher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        // validar datos que vienen en el request
        $request->validate([
            'name' => 'required|max:75',
            'lastname' => 'required|max:75',
            'dni' => 'required|max:15',
            'address' => 'required|max:100',
            'phone' => 'required|max:15',
            'email' => 'required|max:100',
            'salary' => 'required'
        ]);

        // asignar los datos al objeto teacher
        $teacher->name = $request->name;
        $teacher->lastname = $request->lastname;
        $teacher->dni = $request->dni;
        $teacher->address = $request->address;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->salary = $request->salary;

        // guardar el registro en la base de datos
        $teacher->save();

        // guardar un mensaje en la sesión
        Session::flash('mensaje', 'Los datos del profesor han sido actualizados.');

        //redireccionar a la vista del index
        return redirect()->route('teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        // eliminar registro
        $teacher->delete();

        // guardar mensaje en la sesión
        Session::flash('mensaje', "Registro eliminado satisfactoriamente.");

        // redireccionar a la vista del index
        return redirect()->route('teacher.index');
    }
}
