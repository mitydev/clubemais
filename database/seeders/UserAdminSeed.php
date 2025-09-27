<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin']);

        // (Opcional) Cria permissões e vincula à role
        $permissions = ['manage users', 'manage roles', 'manage permissions'];
        foreach ($permissions as $perm) {
            $permission = Permission::firstOrCreate(['name' => $perm]);
            $role->givePermissionTo($permission);
        }

        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('adminweb10@'), // troca depois!
                'email_verified_at' => now()
            ]
        );

        if (!$user->hasRole('admin')) {
            $user->assignRole('admin');
        }
    }
}
