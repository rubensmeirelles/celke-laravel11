<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function loginProcess(LoginRequest $request){

        $request->validated();

        //Validar os dados
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if(!$authenticated){
            //Redireciona para o login novamente
            return back()->withInput()->with('error', 'E-mail ou senha inválidos!');
        }
        //Redireciona para a página pruncipal
        return redirect()->route('dashboard.index');
    }

    public function destroy(){
        Auth::logout();
        return redirect()->route('login.index')->with('success', 'Logout efetuado com sucesso!');
    }
}
