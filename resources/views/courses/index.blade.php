@extends('layouts.admin')

@section('content')
    <h2>Listar os cursos</h2>

    <a href="{{ route('courses.create') }}">Cadastrar</a>

<x-alert />

    <table>
        <tr>
            <thead></thead>
        </tr>
    </table>

    @forelse ($courses as $course)
        Id: {{ $course->id }}<br>
        Nome: {{ $course->name }}<br>
        Preço: {{ 'R$ ' . number_format($course->price, 2, ',' , '.') }}<br>
        Cadastrado em: {{ \Carbon\carbon::parse($course->created_at)->format('d/m/y H:i:s') }}<br>
        Atualizado em: {{ \Carbon\carbon::parse($course->updated_at)->format('d/m/y H:i:s') }}<br>
        <a href="{{ route('courses.show', ['course' => $course->id]) }}"><button type="submit">Visualizar</button></a>
        <a href="{{ route('courses.edit', ['course' => $course->id]) }}"><button type="submit">Editar</button></a>
        <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Coonfirma a exclusão do registro?')">Apagar</button>
        </form>

        <hr>
    @empty
        <p style="color: #f00">Nenhum registro encontrado!</p>
    @endforelse

    {{-- Exibir a paginaçã --}}
    {{-- {{ $courses->links() }} --}}
@endsection

