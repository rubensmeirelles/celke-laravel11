<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showForgotPassword(){
        return view('login.forgotPassword');
    }

    public function submitForgotPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
        ],
        [
           'email.required' => 'Email é obrigatório',
           'email.email' => 'Informe um e-mail válido.',
        ]);
    }
}
