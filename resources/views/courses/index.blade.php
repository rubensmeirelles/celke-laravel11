@extends('layouts.admin')

@section('content')
    <h2>Listar os cursos</h2>

    <a href="{{ route('courses.create') }}">Cadastrar</a>

    @if (session('success'))
        <p style="color: #082">
            {{ session('success') }}
        </p>
    @endif

    <table>
        <tr>
            <thead></thead>
        </tr>
    </table>

    @forelse ($courses as $course)
        {{ $course->id }}<br>
        {{ $course->name }}<br>
        {{ \Carbon\carbon::parse($course->created_at)->format('d/m/y H:i:s') }}<br>
        {{ \Carbon\carbon::parse($course->updated_at)->format('d/m/y H:i:s') }}<br>
        <a href="{{ route('courses.show', ['course' => $course->id]) }}">Visualizar</a>
        <a href="{{ route('courses.edit', ['course' => $course->id]) }}">Editar</a>

        <hr>
    @empty
        <p style="color: #f00">Nenhum registro encontrado!</p>
    @endforelse

    {{-- Exibir a paginaçã --}}
    {{-- {{ $courses->links() }} --}}
@endsection

