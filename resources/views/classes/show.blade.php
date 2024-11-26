@extends('layouts.admin')

@section('content')
    <h2>Detalhes da aula - {{ $classe->name }}</h2>

    <a href="{{ route('classe.index', ['course' => $classe->course_id]) }}">
        <button>Listar aulas</button>
    </a><br><br>
    <a href="{{ route('classe.edit', ['classe' => $classe->id]) }}"><button>Editar</button></a><br><br>

    <x-alert />

    <form action="{{ route('classe.destroy', ['classe' => $classe->id]) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" onclick="return confirm('Coonfirma a exclusão do registro?')">Apagar</button>
    </form>

    Aula: {{ $classe->name }}<br>
    Descrição: {{ $classe->description }}<br>
    Ordem: {{ $classe->order_classe}}<br>
    Cadastrado em: {{ \Carbon\carbon::parse($classe->created_at)->format('d/m/y H:i:s') }}<br>
    Editado em: {{ \Carbon\carbon::parse($classe->updated_at)->format('d/m/y H:i:s') }}<br>
@endsection
