<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

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

        $user = User::where('email', $request->email)->first();
        if(!$user){
            Log::warning('Tentativa de recuperar senha de um e-mail não cadastrado');

            return back()->withInput()->with('error', 'E-mail não encontrado!');
        }

        try{
            $status = Password::sendResetLink($request->only('email'));

            Log::info('Recuperar senha.', ['status' => $status,
            'email' => $request->email]);

            return redirect()->route('login.index')->with('success', 'Enviado e-mail com instruções para recuperar a senha.');

        } catch(Exception $e){
            Log::warning('Erro ao recuperar senha.', ['error' => $e->getMessage(),
            'email' => $request->email]);

            return back()->withInput()->with('error', 'Tente novamente!');
        }
    }

    public function showResetPassword(Request $request){
        dd($request->token);
    }
}
