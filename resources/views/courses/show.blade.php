@extends('layouts.admin')

@section('content')
    <h2>Detalhes do curso</h2>

    <a href="{{ route('courses.index') }}">Listar</a><br>
    <a href="{{ route('courses.edit', ['course' => $course->id]) }}">Editar</a><br><br>

    <x-alert />

    <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" onclick="return confirm('Coonfirma a exclusão do registro?')">Apagar</button>
    </form>

    Id: {{ $course->id }}<br>
    Nome: {{ $course->name }}<br>
    Preço: {{ 'R$ ' . number_format($course->price, 2, ',' , '.') }}<br>
    Cadastrado em: {{ \Carbon\carbon::parse($course->created_at)->format('d/m/y H:i:s') }}<br>
    Editado em: {{ \Carbon\carbon::parse($course->updated_at)->format('d/m/y H:i:s') }}<br>
@endsection
