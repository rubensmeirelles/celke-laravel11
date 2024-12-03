@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2>Usuários</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item active">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-decoration-none">Usuários</a>
            </li>
        </ol>
    </div>

    <div class="card mb-4 hstack gap-2">
        <span class="card-header">Listar</span>
        <span class="ms-auto">
            <a href="{{ route('user.create') }}" class="btn btn-success btn-sm">Cadastrar</a>
        </span>
    </div>

    <div class="card-body">
        <x-alert />

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="d-none d-md-table-cell">Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th class="text-center">Ações</th>
                  </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="d-none d-md-table-cell">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="d-md-flex flex-row justify-content-center">
                            <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-info btn-sm me-1 mt-1 mt-md-0">Visualizar</a>
                            <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-primary btn-sm me-1 mt-1 mt-md-0">Editar</a>

                            <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm mt-1 mt-md-0" type="submit" onclick="return confirm('Coonfirma a exclusão do registro?')">Apagar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <div class="alert alert-danger" role="alert">
                        Nenhum registro encontrado!
                    </div>
                @endforelse
            </tbody>
        </table>
        {{-- {{ $user->links() }} --}}
    </div>
</div>

@endsection
