<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;

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
        return view('course.show', ['course' => $course]);
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

        DB::beginTransaction();

        try{

        $course = Course::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        DB::commit();

        return redirect()->route('courses.index', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso');
        } catch(Exception $e){
            DB::rollback();

            return back()->withInput()->with('error', 'Curso não cadastrado!');
        }
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

        DB::beginTransaction();

        try{
            $course->update([
                'name'=>$request->name,
                'price'=>$request->price,
            ]);

            DB::commit();

            return redirect()->route('courses.index', ['course' => $course->id])->with('success', 'Curso editado com sucesso!');
        }

        catch(Exception $e){
            DB::rollback();

            return back()->withInput()->with('error', 'Curso não editado!');
        }
    }

    // Deletar o curso
    public function destroy(Course $course){
        try{
            $course->delete();
            return redirect()->route('courses.index', ['course' => $course->id])->with('success', 'Curso excluído com sucesso!');
        } catch(Exception $e){
            return redirect()->route('courses.index', ['course' => $course->id])->with('error', 'Curso não excluído!');
        }

    }


}
