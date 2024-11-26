<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Illuminate\Http\Request;

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

        // Recuperar a última ordem da aula do curso
        $lastOrderClasse = Classe::where('course_id', $request->course_id)
        ->orderBy('order_classe', 'DESC')
        ->first();

        // Cadastrar a aula do curso
        Classe::create([
            'name' => $request->name,
            'description' => $request->description,
            // 'order_classe' => $request->order_classe,
            'order_classe' => $lastOrderClasse ? $lastOrderClasse->order_classe + 1 : 1,
            'course_id' => $request->course_id
        ]);

        // Redirecionar o usuário
        return redirect()->route('classe.index', ['course' => $request->course_id])->with('success', 'Aula cadastrada com sucesso!');
    }

    public function edit(Classe $classe){
        return view('classes.edit', ['classe' => $classe]);
    }

    public function update(ClasseRequest $request, Classe $classe){
        $request->validated();

        $classe->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula editada com suceso!');
    }

    public function show(Classe $classe){
        return view('classes.show', ['classe' => $classe]);
    }

    public function destroy(Classe $classe){
        $classe->delete();
        return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula excluída com suceso!');
    }
}
