@extends('layouts.admin')

@section('content')
    <h2>Cadastrar curso</h2>

    <a href="{{ route('courses.index') }} ">Listar</a>

    @if (session('success'))
        <p style="color: #082">
            {{ session('success') }}
        </p>
    @endif

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        @method('POST')

        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome do curso" value="{{ old('name') }}" required><br><br>
        <label for="name">Preço:</label>
        <input type="text" name="price" id="price" placeholder="price do curso: 0.00" value="{{ old('price') }}" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>
@endsection
