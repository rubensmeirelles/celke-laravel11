@extends('layouts.admin')

@section('content')
    <h2>Cadastrar aula - curso de {{ $course->name }}</h2>

    <a href="{{ route('classe.index', ['course' => $course->id]) }}">
        <button>Listar aulas</button>
    </a><br><br>

    <x-alert />

    <form action="{{ route('classe.store') }}" method="POST">
        @csrf
        @method('POST')

        <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">

        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome da aula" value="{{ old('name') }}" required><br><br>
        <label for="description">Descrição:</label>
        <textarea name="description" id="description" cols="30" rows="10" required>{{ old('description') }}</textarea><br><br>
        <button type="submit">Cadastrar</button>
    </form>
@endsection
