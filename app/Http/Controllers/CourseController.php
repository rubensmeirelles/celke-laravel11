<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){
        //Recuperar os registros do banco
        // $courses = Course::where('id', 1000)->get();
        // $courses = Course::paginate(2);
        // $courses = Course::orderBy('id','DESC')->get();
        $courses = Course::get();

        // CARREGAR A VIEW
        return view('courses.index', ['courses' => $courses]);
    }

    // Visualizar os cursos
    public function show(Course $course){

        // dd($request->course);

        //$course = Course::where( 'id', $request->course)->first();
        // dd($course);

        // CARREGAR A VIEW
        return view('courses.show', ['course' => $course]);
    }

    // Criar os cursos
    public function create(){
        // CARREGAR A VIEW
        return view('courses.create');
    }

    // Cadastrar os cursos no banco de dados
    public function store(Request $request){
        Course::create([
            'name' => $request->name
        ]);

        return redirect()->route('courses.create')->with('success', 'Curso cadastrado com sucesso');
    }

    // Editar o curso
    public function edit(){
        // CARREGAR A VIEW
        return view('courses.edit');
    }

    // Editar o registro no banco de dados
    public function update(){
        dd('Editar no banco de dados');
    }

    // Editar o curso
    public function destroy(){
        dd('Excluir');
    }


}
