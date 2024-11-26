@extends('layouts.admin')

@section('content')
    <h2>Listar aulas</h2>

    <a href="{{ route('courses.index') }}">
        <button>Cursos</button>
    </a><br><br>

    <a href="{{ route('classe.create', ['course' => $course->id]) }}">
        <button>Cadastrar</button>
    </a><br><br>

<x-alert />

    @forelse ($classes as $classe)
        Id: {{ $classe->id }}<br>
        Nome: {{ $classe->name }}<br>
        Descrição: {{ $classe->description }}<br>
        Curso: {{ $classe->course->name }}<br><br>
        <a href="{{ route('classe.edit', ['classe' => $classe->id]) }}"><button type="submit">Editar</button></a><br><br>
        <a href="{{ route('classe.show', ['classe' => $classe->id]) }}"><button type="submit">Visualizar</button></a><br><br>

        <form action="{{ route('classe.destroy', ['classe' => $classe->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Coonfirma a exclusão do registro?')">Apagar</button>
        </form>

        <hr>
    @empty
        <p style="color: #f00">Nenhuma aula encontrada!</p>
    @endforelse

    {{-- Exibir a paginaçã --}}
    {{-- {{ $courses->links() }} --}}
@endsection

