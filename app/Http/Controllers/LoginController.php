<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        //Obter o usuário autenticado
        $user = Auth::user();
        $user = User::find($user->id);

        //Verifica qual é a permissão do usuário
        if($user->hasRole('Super Admin')){
            //Usuário possui todas as permissões
            $permissions = Permission::pluck('name')->toArray();

        } else {
            //Recupera do bd todas as permissões do usuário
            $permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();
        }
        //Atribui as permissões ao usuário
        $user->syncPermissions($permissions);

        //Redireciona para a página pruncipal
        return redirect()->route('dashboard.index');
    }

    public function create(){
        return view('login.create');
    }

    public function store(LoginUserRequest $request){
        //dd($request);
        $request->validated();

        DB::beginTransaction();

        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            //Definir o perfil do usuário
            $user->assignRole("Aluno");

            Log::info('Usuário cadastrado', ['id' => $user->id]);

            DB::commit();

            return redirect()->route('login.index')->with('success', 'Usuário cadastrado com sucesso!');
        }

        catch(Exception $e){
            Log::warning('Usuário não cadastrado', ['error' => $e->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }

    public function destroy(){
        Auth::logout();
        return redirect()->route('login.index')->with('success', 'Logout efetuado com sucesso!');
    }

    public function roles(){
        $roles = Role::orderBy('name');
        
        return view('roles.index', ['roles' => $roles]);
    }
}
