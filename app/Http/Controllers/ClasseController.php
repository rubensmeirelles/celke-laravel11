<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    public function index(Course $course){
        //dd($course);
        $classes = Classe::with('course')
        ->where('course_id', $course->id)
        ->orderBy('order_classe')
        ->get();

        // Carregar a view
        return view('classes.index', ['course' => $course, 'classes' => $classes]);
    }

    public function create(Course $course){
        return view('classes.create', ['course' => $course]);
    }

    public function store(ClasseRequest $request){

        //Validar o formulário
        $request->validated();

        DB::beginTransaction();

        try{

        // Recuperar a última ordem da aula do curso
        $lastOrderClasse = Classe::where('course_id', $request->course_id)
        ->orderBy('order_classe', 'DESC')
        ->first();

        // Cadastrar a aula do curso
        Classe::create([
            'name' => $request->name,
            'description' => $request->description,
            'order_classe' => $lastOrderClasse ? $lastOrderClasse->order_classe + 1 : 1,
            'course_id' => $request->course_id
        ]);

        DB::commit();

        // Redirecionar o usuário
        return redirect()->route('classe.index', ['course' => $request->course_id])->with('success', 'Aula cadastrada com sucesso!');
    }
    catch(Exception $e){
        DB::rollback();

        return back()->withInput()->with('error', 'Aula não cadastrada!');
    }
}

    public function edit(Classe $classe){
        return view('classes.edit', ['classe' => $classe]);
    }

    public function update(ClasseRequest $request, Classe $classe){
        $request->validated();

        DB::beginTransaction();

        try{

            $classe->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            DB::commit();

            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula editada com suceso!');
        }
        catch(Exception $e){
            DB::rollback();

            return back()->withInput()->with('error', 'Aula não editada!');
        }
    }

    public function show(Classe $classe){
        return view('classes.show', ['classe' => $classe]);
    }


    public function destroy(Classe $classe){
        try{
            $classe->delete();
            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula excluída com suceso!');
        } catch(Exception $e){
            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('error', 'Aula não excluída!');
        }

    }
}
