@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Perfis</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item active">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">Perfis</li>
        </ol>
    </div>

    <div class="card mb-4 hstack gap-2">
        <span class="card-header">Listar</span>
        <span class="ms-auto">
            @can('create-role',)
                <a href="{{ route('role.create') }}" class="btn btn-success btn-sm">Cadastrar</a>
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
                    <th class="text-center">Ações</th>
                  </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td class="d-none d-md-table-cell">{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td class="d-md-flex flex-row justify-content-center">
                            @can('show-role')
                                <a href="{{ route('role.show', ['role' => $role->id]) }}" class="btn btn-info btn-sm me-1 mt-1 mt-md-0">Visualizar</a>
                            @endcan

                            @can('edit-role')
                                <a href="{{ route('role.edit', ['role' => $role->id]) }}" class="btn btn-primary btn-sm me-1 mt-1 mt-md-0">Editar</a>
                            @endcan

                            {{-- @can('update') --}}
                                <a href="{{ route('classe.index', ['course' => $role->id]) }}" class="btn btn-secondary btn-sm me-1 mt-1 mt-md-0">Permissões</a>
                            {{-- @endcan --}}

                            @can('destroy-role')
                                <form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm mt-1 mt-md-0" type="submit" onclick="return confirm('Coonfirma a exclusão do registro?')">Apagar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <div class="alert alert-danger" role="alert">
                        Nenhum perfil encontrado!
                    </div>
                @endforelse
            </tbody>
        </table>
        {{-- Exibir a paginaçã --}}
    {{ $roles->links() }}
    </div>
</div>

@endsection

