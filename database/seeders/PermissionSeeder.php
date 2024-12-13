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
            'index-course',
            'show-course',
            'create-course',
            'edit-course',
            'destroy-course',

            'index-classe',
            'show-classe',
            'create-classe',
            'edit-classe',
            'destroy-classe'
        ];



        foreach($permissions as $permission){
            $existingPermission = Permission::where('name', $permission)->first();

            if(!$existingPermission){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web'
                ]);
            }

        }
    }
}
