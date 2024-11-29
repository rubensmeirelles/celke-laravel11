@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2>Cadastrar aula - curso de {{ $course->name }}</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item active">
                <a href="" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('classe.index', ['course' => $course->id]) }}" class="text-decoration-none">Aulas</a>
            </li>
        </ol>
    </div>
    <div class="card mb-4 hstack gap-2">
        <span class="card-header">Cadastrar</span>
        <span class="ms-auto">
            <a href="{{ route('classe.index', ['course' => $course->id]) }}" class="btn btn-secondary btn-sm">Listar</a>
        </span>
    </div>

    <div class="card-body">
        <x-alert />

        <form class="row g-3" action="{{ route('classe.store') }}" method="POST">
            @csrf
            @method('POST')

            <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">

            <div class="col-12">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nome da aula" value="{{ old('name') }}" required><br><br>
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Descrição:</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="4" required>{{ old('description') }}</textarea><br><br>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
            </div>
        </form>
    </div>

</div>

@endsection
