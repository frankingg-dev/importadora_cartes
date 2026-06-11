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
            ['email' => 'admin@impcartes.cl'],
            [
                'name' => 'Administrador Cartes',
                'password' => Hash::make('cartes123'),
            ]
        );

        $admin->assignRole($adminRole);
    }
}
