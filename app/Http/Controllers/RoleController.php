<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::orderBy('name')->paginate(40);

        Log::info('Listar perfis', ['action_user_id' => Auth::id()]);

        return view('roles.index', ['roles' => $roles]);
    }

    public function show(Role $role){

        return view('roles.show', ['roles' => $role]);
    }

    // Criar os perfis
    public function create(){
        // CARREGAR A VIEW
        return view('roles.create');
    }

    // Cadastrar os perfis no banco de dados
    public function store(RoleRequest $request){

        //Validar o formulário
        $request->validated();

        DB::beginTransaction();

        try{

        $role = Role::create([
            'name' => $request->name,
        ]);

        DB::commit();

        Log::info('Perfil não cadastrado', ['role_id' => $role->id]);

        return redirect()->route('role.index', ['role' => $role->id])->with('success', 'Perfil cadastrado com sucesso');
        } catch(Exception $e){
            DB::rollback();

            Log::warning('Perfil não cadastrado', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Perfil não cadastrado!');
        }
    }

    public function edit(Role $role){

        //dd($role);
        // CARREGAR A VIEW
        return view('roles.edit', ['role' => $role]);
    }

    // Editar o registro no banco de dados
    public function update(RoleRequest $request, Role $role){

        //Validar o formulário
        $request->validated();

        DB::beginTransaction();

        try{
            $role->update([
                'name'=>$request->name,
            ]);

            DB::commit();

            return redirect()->route('role.index', ['role' => $role->id])->with('success', 'Perfil editado com sucesso!');
        }

        catch(Exception $e){
            DB::rollback();

            return back()->withInput()->with('error', 'Perfil não editado!');
        }
    }

    // Deletar o curso
    public function destroy(Role $role){
        try{
            $role->delete();
            return redirect()->route('role.index', ['role' => $role->id])->with('success', 'Perfil excluído com sucesso!');
        } catch(Exception $e){
            return redirect()->route('role.index', ['role' => $role->id])->with('error', 'Perfil não excluído!');
        }
    }
}
