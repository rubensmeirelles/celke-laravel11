@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Permissões do Perfil - {{ $role->name }}</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item active">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ route('role.index') }}" class="text-decoration-none">Permissões</a>
            </li>
            <li class="breadcrumb-item">Perfis</li>
        </ol>
    </div>

    <div class="card mb-4 hstack gap-2">
        <span class="card-header">Listar</span>
        <span class="ms-auto">
            @can('index-role',)
                <a href="{{ route('role.index') }}" class="btn btn-info btn-sm">Listar</a>
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
                    <th>Título</th>
                    <th class="text-center">Ações</th>
                  </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $permission)
                <tr>
                    <td class="d-none d-md-table-cell">{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->title }}</td>
                    <td>
                        @if (in_array($permission->id, $rolePermissions ?? []))
                            <span class="badge text-bg-success">Liberado</span>
                            @else
                            <span class="badge text-bg-danger">Bloqueado</span>
                        @endif
                    </td>
                </tr>
                @empty
                    <div class="alert alert-danger" role="alert">
                        Nenhuma permissão encontrada para o perfil selecionado!
                    </div>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

