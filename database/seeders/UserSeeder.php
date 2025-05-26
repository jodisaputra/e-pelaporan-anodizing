<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'spare-part-list',
            'spare-part-create',
            'spare-part-edit',
            'spare-part-delete',
            'action-list',
            'action-create',
            'action-edit',
            'action-delete',
        ];

        // Gunakan firstOrCreate untuk menghindari duplicate saat re-run seeder
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create role admin
        $adminRole = Role::firstOrCreate(['name' => RolesEnum::ADMIN->value]);
        $operatorRole = Role::firstOrCreate(['name' => RolesEnum::OPERATOR->value]);
        $technicianRole = Role::firstOrCreate(['name' => RolesEnum::TECHNICIAN->value]);
        $adminRole->syncPermissions($permissions); // Gunakan sync untuk update permissions

        // Create admin user dengan firstOrCreate untuk menghindari duplicate
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Unique identifier
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(), // Tambahkan email verified
            ]
        );

        // Assign role (akan skip jika sudah ada)
        if (!$adminUser->hasRole(RolesEnum::ADMIN->value)) {
            $adminUser->assignRole(RolesEnum::ADMIN->value);
        }

        $this->command->info('Admin user created successfully!');
        $this->command->info('Username: ' .$adminUser->username);
        $this->command->info('Password: password');
    }
}