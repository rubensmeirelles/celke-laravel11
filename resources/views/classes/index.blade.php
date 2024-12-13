@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2>Aulas</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item active">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('courses.index') }}" class="text-decoration-none btn btn-warning btn-sm">Cursos</a>
            </li>
        </ol>
    </div>

    <div class="card mb-4 hstack gap-2">
        <span class="card-header">Listar</span>

        <span class="ms-auto">
            @can('create-classe')
                <a href="{{ route('classe.create', ['course' => $course->id]) }}" class="btn btn-success btn-sm">Cadastrar</a>
            @endcan
        </span>
    </div>

    <div class="card-body">
        <x-alert />

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="d-none d-md-table-cell">Id</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th class="text-center">Ações</th>
                  </tr>
            </thead>

            <tbody>
                @forelse ($classes as $classe)
                    <tr>
                        <td class="d-none d-md-table-cell">{{ $classe->id }}</td>
                        <td>{{ $classe->name }}</td>
                        <td>{{ $classe->description }}</td>
                        <td class="d-md-flex flex-row justify-content-center">

                            <a href="{{ route('classe.show', ['classe' => $classe->id]) }}" class="btn btn-info btn-sm me-1 mt-1 mt-md-0">Visualizar</a>
                            <a href="{{ route('classe.edit', ['classe' => $classe->id]) }}" class="btn btn-primary btn-sm me-1 mt-1 mt-md-0">Editar</a>

                            <form action="{{ route('classe.destroy', ['classe' => $classe->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm mt-1 mt-md-0" type="submit" onclick="return confirm('Coonfirma a exclusão do registro?')">Apagar</button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <div class="alert alert-danger" role="alert">
                        Nenhuma aula encontrada!
                    </div>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

