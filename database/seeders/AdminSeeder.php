<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles si no existen
        Role::firstOrCreate(['name' => 'administrador']);
        Role::firstOrCreate(['name' => 'operador']);
        Role::firstOrCreate(['name' => 'docente']);
        Role::firstOrCreate(['name' => 'postulante']);

        // Crear admin
        $user = User::firstOrCreate(
            ['email' => 'admin@prueba.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
            ]
        );

        $user->syncRoles(['administrador']);
    }
}