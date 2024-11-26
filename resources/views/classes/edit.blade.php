@extends('layouts.admin')

@section('content')
    <h2>Editar aula - curso de {{ $classe->course->name }}</h2>

    <a href="{{ route('classe.index', ['course' => $classe->course_id]) }}">
        <button>Listar aulas</button>
    </a><br><br>

    <x-alert />

    {{-- {{dd($classe->course->name)}} --}}

    <form action="{{ route('classe.update', ['classe' => $classe->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome da aula" value="{{ old('name', $classe->name) }}" required><br><br>
        <label for="description">Descrição:</label>
        <textarea name="description" id="description" cols="30" rows="10" required>{{ old('description', $classe->description) }}</textarea><br><br>
        <button type="submit">Editar</button>
    </form>
@endsection
