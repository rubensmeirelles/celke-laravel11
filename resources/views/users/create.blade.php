@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Usuário</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item active">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('user.index') }}" class="text-decoration-none">Usuários</a>
                </li>
                <li class="breadcrumb-item">Usuários</li>
            </ol>
        </div>

        <div class="card mb-4 hstack gap-2">
            <span class="card-header">Cadastrar</span>
            <span class="ms-auto">
                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">Listar</a>
            </span>
        </div>

        <div class="card-body">
            <x-alert />

            <form class="row g-3" action="{{ route('user.store') }}" method="POST">
                @csrf
                @method('POST')

                <div class="col-12 col-md-6">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nome do usuário" value="{{ old('name') }}">
                </div>

                <div class="col-12 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="mail" class="form-control" id="email" name="email" placeholder="mail@mail.com" value="{{ old('email') }}">
                </div>

                <div class="col-12 col-md-6">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha de acesso. Mínimo 6 caracteres" value="{{ old('password') }}">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
                </div>

            </form>
        </div>
    </div>
@endsection;
