<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){
        //Recuperar os registros do banco
        //$courses = Course::where('id', 1000)->get();
        // $courses = Course::paginate(2);
        // $courses = Course::orderBy('id','DESC')->get();
        $courses = Course::orderBy('name', 'ASC')->get();

        //Salvar log
        Log::info('Listar cursos.');

        // CARREGAR A VIEW
        return view('courses.index', ['courses' => $courses]);
    }

    // Visualizar os cursos
    public function show(Course $course){

        // dd($request->course);

        //$course = Course::where( 'id', $request->course)->first();
        // dd($course);

        Log::info('Visualizar cursos', ['course_id' => $course->id]);

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

        DB::beginTransaction();

        try{

        $course = Course::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        DB::commit();

        Log::info('Curso não cadastrado', ['course_id' => $course->id]);

        return redirect()->route('courses.index', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso');
        } catch(Exception $e){
            DB::rollback();

            Log::warning('Curso não cadastrado', ['error' => $e->getMessage()]);

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
