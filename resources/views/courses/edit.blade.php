@extends('layouts.admin')

@section('content')
    <h2>Editar curso</h2>

    <a href="{{ route('courses.index') }}">Listar</a>
    <a href="{{ route('courses.show', ['course' => $course->id]) }}">Visualizar</a>
    <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" onclick="return confirm('Coonfirma a exclusão do registro?')">Apagar</button>
    </form>

    {{-- {{ dd($course) }} --}}

    <x-alert />

    <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="">Nome: </label>
        <input type="text" name="name" id="name" placeholder="Nome do curso" value="{{ old('name', $course->name) }}"
            > <br><br>
        <label for="">Preço: </label>
        <input type="text" name="price" id="price" placeholder="price do curso: 0.00" value="{{ old('price', $course->price) }}"
        > <br><br>
        <button type="submit">Salvar</button>

    </form>
@endsection
