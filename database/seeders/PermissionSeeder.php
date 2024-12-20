<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['title' => 'Listar cursos', 'name' => 'index-course'],
            ['title' => 'Visualizar curso', 'name' => 'show-course'],
            ['title' => 'Cadastrar curso', 'name' => 'create-course'],
            ['title' => 'Editar curso', 'name' => 'edit-course'],
            ['title' => 'Excluir curso', 'name' => 'destroy-course'],

            ['title' => 'Listar aulas', 'name' => 'index-classe'],
            ['title' => 'Visualizar aula', 'name' => 'show-classe'],
            ['title' => 'Cadastrar aula', 'name' => 'create-classe'],
            ['title' => 'Editar aula', 'name' => 'edit-classe'],
            ['title' => 'Excluir aula', 'name' => 'destroy-classe'],

            ['title' => 'Listar perfis', 'name' => 'index-role'],
            ['title' => 'Visualizar perfil', 'name' => 'show-role'],
            ['title' => 'Editar perfil', 'name' => 'edit-role'],
            ['title' => 'Excluir perfil', 'name' => 'destroy-role'],

            ['title' => 'Listar permissões do perfil', 'name' => 'index-role-permission'],

        ];



        foreach($permissions as $permission){
            $existingPermission = Permission::where('name', $permission['name'])->first();

            if(!$existingPermission){
                Permission::create([
                    'title' => $permission['title'],
                    'name' => $permission['name'],
                    'guard_name' => 'web'
                ]);
            }

        }
    }
}
