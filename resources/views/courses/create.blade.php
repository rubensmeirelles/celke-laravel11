@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Curso</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item active">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                @can('index-course')
                    <a href="{{ route('courses.index') }}" class="text-decoration-none">Cursos</a>
                @endcan
            </li>
            <li class="breadcrumb-item">Curso</li>
        </ol>
    </div>

    <div class="card mb-4 hstack gap-2">
        <span class="card-header">Cadastrar</span>
        <span class="ms-auto">
            @can('index-course')
                <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">Listar</a>
            @endcan
        </span>
    </div>

    <div class="card-body">
        <x-alert />

        <form class="row g-3" action="{{ route('courses.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="col-12 col-md-6">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nome do curso" value="{{ old('name') }}">
              </div>
              <div class="col-12 col-md-6">
                <label for="price" class="form-label">Preço</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Preço do curso: 0.00" value="{{ old('price') }}">
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
              </div>

        </form>
    </div>

</div>
    {{-- Exibir a paginaçã --}}
    {{-- {{ $courses->links() }} --}}
@endsection


