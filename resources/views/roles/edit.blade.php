@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Perfil</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item active">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                @can('index-course')
                    <a href="{{ route('role.index') }}" class="text-decoration-none">Perfis</a>
                @endcan
            </li>
            <li class="breadcrumb-item">Perfil</li>
        </ol>
    </div>

    <div class="card mb-4 hstack gap-2">
        <span class="card-header">Editar</span>
        <span class="ms-auto">
            @can('index-role')
                <a href="{{ route('role.index') }}" class="btn btn-secondary btn-sm">Listar</a>
            @endcan
            @can('show-role')
                <a href="{{ route('role.show', ['role' => $role->id]) }}" class="btn btn-info btn-sm">Visualizar</a>
            @endcan
        </span>
    </div>

    <div class="card-body">
        <x-alert />

        <form class="row g-3" action="{{ route('role.update', ['role' => $role->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="col-12 col-md-6">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nome do perfil" value="{{ old('name', $role->name) }}">
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
              </div>

        </form>


    </div>

</div>
    {{-- Exibir a paginaçã --}}
    {{-- {{ $courses->links() }} --}}
@endsection


