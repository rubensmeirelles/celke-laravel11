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
        Curso: {{ $classe->course->name }}<br>
        Ordem: {{ $classe->order_classe}}<br>
        Cadastrado em: {{ \Carbon\carbon::parse($classe->created_at)->format('d/m/y H:i:s') }}<br>
        Atualizado em: {{ \Carbon\carbon::parse($classe->updated_at)->format('d/m/y H:i:s') }}<br>
        {{-- <a href="{{ route('courses.show', ['course' => $course->id]) }}"><button type="submit">Visualizar</button></a>
        <a href="{{ route('courses.edit', ['course' => $course->id]) }}"><button type="submit">Editar</button></a>
        <a href="{{ route('classe.index', ['course' => $course->id]) }}"><button type="submit">Aulas</button></a>


        <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Coonfirma a exclusão do registro?')">Apagar</button>
        </form> --}}

        <hr>
    @empty
        <p style="color: #f00">Nenhuma aula encontrada!</p>
    @endforelse

    {{-- Exibir a paginaçã --}}
    {{-- {{ $courses->links() }} --}}
@endsection

