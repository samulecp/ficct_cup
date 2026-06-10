<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Administrador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'administrador']);
        Role::firstOrCreate(['name' => 'operador']);
        Role::firstOrCreate(['name' => 'docente']);
        Role::firstOrCreate(['name' => 'postulante']);

        $user = User::firstOrCreate(
            ['email' => 'admin@prueba.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
            ]
        );

        $user->syncRoles(['administrador']);

        Administrador::firstOrCreate(
    ['user_id' => $user->id],
    [
        'ci' => '12345678',
        'telefono' => '70000000',
        'estado' => true,
    ]
);
    }
}