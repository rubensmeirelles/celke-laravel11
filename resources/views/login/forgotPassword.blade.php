@extends('layouts.login')
@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Recuperar Senha</h3>
                                </div>
                                <div class="card-body">
                                    <x-alert />
                                    <form action="{{ route('forgot-password.submit') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}"/>
                                            <label for="email">E-mail</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary btn-sm" onclick="this.innerText = 'Aguarde...'">Recuperar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="{{ route('login.index' )}}">Clique aqui </a>para acessar.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>

@endsection

</html>
