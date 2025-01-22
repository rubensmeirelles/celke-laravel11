<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index(Role $role) {

        if($role->name == 'Super Admin'){
            Log::info('Permissões do Super Admin não podem ser acessadas.', ['action_user_id' => Auth::id()]);

            return redirect()->route('role.index')->with('error', 'Permissão do super admin não pode ser acessada!');
        }
        // Recuperar as permissões do perfil no banco de dados
        $role_permissions = DB::table('role_has_permissions')
            ->where('role_id', $role->id)
            ->pluck('permission_id')
            ->all();

        // Recuperar as permissões
        $permissions = Permission::get();

        Log::info('Listar permissões do perfil.', ['role_id' => $role->id, 'action_user_id' => Auth::id()]);

        return view('rolePermission.index', [
            'menu' => 'roles',
            'rolePermissions' => $role_permissions,
            'permissions' => $permissions,
            'role' => $role,
        ]);

        //dd($permission);
    }

    public function update(Request $request, Role $role){
        $permission = Permission::find($request->permission);

        if(!$permission){
            Log::info('Permissão não encontrada.', ['role' => $role->id, 'permission' => $request->permission, 'action_user_id' => Auth::id()]);

            return redirect()->route('role-permission.update', ['role' => $role->id, 'permission' => $request->permission])->with('error', 'Permissão não encontrada.');

        }

        if($role->permissions->contains($permission)){
            $role->revokePermissionTo($permission);

            Log::info('Bloquear permissão para o perfil.', ['role' => $role->id, 'permission' => $request->permission, 'action_user_id' => Auth::id()]);

            return redirect()->route('role-permission.index', ['role' => $role->id, 'permission' => $request->permission])->with('error', 'Permissão bloqueada com sucesso.');

            }else{
                $role->givePermissionTo($permission);

                Log::info('Liberar permissão para o perfil.', ['role' => $role->id, 'permission' => $request->permission, 'action_user_id' => Auth::id()]);

                return redirect()->route('role-permission.index', ['role' => $role->id, 'permission' => $request->permission])->with('error', 'Permissão liberada com sucesso.');
            }
        }
}
