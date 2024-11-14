@extends('layouts.admin')

@section('content')
    <h2>Editar curso</h2>

    <a href="{{ route('courses.index') }}">Listar</a>
    <a href="{{ route('courses.show', ['course' => $course->id]) }}">Visualizar</a>

    {{-- {{ dd($course) }} --}}

    <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="">Nome: </label>
        <input type="text" name="name" id="name" placeholder="Nome do curso" value="{{ old('name', $course->name) }}"
            required>
        <button type="submit">Salvar</button>

    </form>
@endsection
