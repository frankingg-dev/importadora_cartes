<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear los únicos dos roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $clientRole = Role::firstOrCreate(['name' => 'cliente']);

        // 2. Crear usuario Admin inicial
        $admin = User::firstOrCreate(
            ['email' => 'admin@kautoimport.io'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'),
            ]
        );

        $admin->assignRole($adminRole);
    }
}
