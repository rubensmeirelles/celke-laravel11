<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
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
    public function store(CourseRequest $request){

        //Validar o formulário
        $request->validated();

        $course = Course::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('courses.index', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso');
    }

    // Editar o curso
    public function edit(Course $course){

        //dd($course);
        // CARREGAR A VIEW
        return view('courses.edit', ['course' => $course]);
    }

    // Editar o registro no banco de dados
    public function update(CourseRequest $request, Course $course){

        //Validar o formulário
        $request->validated();

        $course->update([
            'name'=>$request->name,
            'price'=>$request->price,
    ]);
        return redirect()->route('courses.index', ['course' => $course->id])->with('success', 'Curso editado com sucesso!');
    }

    // Deletar o curso
    public function destroy(Course $course){

        $course->delete();
        return redirect()->route('courses.index', ['course' => $course->id])->with('success', 'Curso excluído com sucesso!');
    }


}
