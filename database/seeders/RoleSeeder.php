<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::query()
            ->create([
                'name' => 'Vinco',
                'email' => 'admin@vinco.com',
                'password' => Hash::make('vinco-lms'),
            ]);

        $role = Role::create(['name' => 'Super Admin']);

        $permission = Permission::query()
            ->pluck('id', 'id')
            ->all();
        $role->syncPermissions($permission);
        $admin->assignRole([$role->id]);
    }
}
