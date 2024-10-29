<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){
        // CARREGAR A VIEW
        return view('courses.index');
    }

    // Visualizar os cursos
    public function show(){
        // CARREGAR A VIEW
        return view('courses.show');
    }

    // Criar os cursos
    public function create(){
        // CARREGAR A VIEW
        return view('courses.create');
    }

    // Cadastrar os cursos no banco de dados
    public function store(){
        dd('Cadastar');
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
