@extends('layouts.admin')

@section('content')
    <h2>Detalhes do curso</h2>

    <a href="{{ route('courses.index') }}">Listar</a><br>
    <a href="{{ route('courses.edit', ['course' => $course->id]) }}">Editar</a><br><br>

    Id: {{ $course->id }}<br>
    Nome: {{ $course->name }}<br>
    Cadastrado em: {{ \Carbon\carbon::parse($course->created_at)->format('d/m/y H:i:s') }}<br>
    Editado em: {{ \Carbon\carbon::parse($course->updated_at)->format('d/m/y H:i:s') }}<br>
@endsection
