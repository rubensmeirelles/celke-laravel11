@extends('layouts.admin')

@section('content')
    <h2>Listar os cursos</h2>

    <a href="{{ route('courses.show') }}">Visualizar</a>
    <a href="{{ route('courses.create') }}">Cadastrar</a>

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

        <hr>
    @empty
        <p style="color: #f00">Nenhum registro encontrado!</p>
    @endforelse

    {{-- Exibir a paginaçã --}}
    {{-- {{ $courses->links() }} --}}
@endsection

