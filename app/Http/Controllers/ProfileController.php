<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function show(){
        //Recuperar dados do usuário logado
        $user = User::where('id', Auth::id())->first();
        return view('profile.show', ['user' => $user]);
    }

    public function edit()
    {
        $user = User::where('id', Auth::id())->first();

        // Carregar a VIEW
        return view('profile.edit', ['menu' => 'users', 'user' => $user]);
    }

    public function update(ProfileRequest $request)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {
            $user = User::where('id', Auth::id())->first();

            // Editar as informações do registro no banco de dados
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Salvar log
            Log::info('Perfil editado.', ['id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('profile.show', ['user' => $request->user])->with('success', 'Perfil editado com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Perfil não editado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Perfil não editado!');
        }
    }

    public function editPassword()
    {
        $user = User::where('id', Auth::id())->first();
        // Carregar a VIEW
        return view('profile.editPassword', ['user' => $user]);
    }

    public function updatePassword(Request $request)
    {

        // Validar o formulário
        $request->validate([
            'password' => 'required|min:6',
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {
            $user = User::where('id', Auth::id())->first();

            // Editar as informações do registro no banco de dados
            $user->update([
                'password' => $request->password,
            ]);

            // Salvar log
            Log::info('Senha do perfil editada.', ['id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o perfil, enviar a mensagem de sucesso
            return redirect()->route('profile.show')->with('success', 'Senha do perfil editada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Senha do perfil não editada.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o perfil, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Senha do perfil não editada!');
        }
    }
}
