@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Curso {{ $course->name }}</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item active">
                <a href="#" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">Curso</li>
        </ol>
    </div>

    <div class="card mb-4 hstack gap-2">
        <span class="card-header">Visualizar</span>
        <span class="ms-auto">
            <a href="{{ route('classe.index', ['course' => $course->id]) }}" class="btn btn-info btn-sm">Aulas</a>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">Listar</a>
        </span>
    </div>

    <div class="card-body">
        <x-alert />

        <dl class="row">
            <dt class="col-sm-3">Id</dt>
            <dd class="col-sm-9">{{ $course->id }}</dd>

            <dt class="col-sm-3">Preço</dt>
            <dd class="col-sm-9">{{ 'R$ ' . number_format($course->price, 2, ',' , '.') }}</dd>

            <dt class="col-sm-3">Cadastrado em:</dt>
            <dd class="col-sm-9">{{ \Carbon\carbon::parse($course->created_at)->format('d/m/y H:i:s') }}</dd>

            <dt class="col-sm-3">Editado em:</dt>
            <dd class="col-sm-9">{{ \Carbon\carbon::parse($course->updated_at)->format('d/m/y H:i:s') }}</dd>

        </dl>
    </div>
    <div class="d-flex flex-row">
        <a href="{{ route('courses.edit', ['course' => $course->id]) }}" class="btn btn-primary btn-sm me-1 mt-1 mt-md-0">Editar</a>

        <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button class="btn btn-danger btn-sm mt-1 mt-md-0" type="submit" onclick="return confirm('Coonfirma a exclusão do registro?')">Apagar</button>
        </form>
    </div>

</div>
    {{-- Exibir a paginaçã --}}
    {{-- {{ $courses->links() }} --}}
@endsection


