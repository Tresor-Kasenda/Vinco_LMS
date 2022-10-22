<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

final class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Super Admin',
            'Etudiant',
            'Parent',
            'Manager',
            'Professeur',
            'Comptable',
        ];

        foreach ($roles as $role) {
            Role::query()
                ->create([
                    'name' => $role,
                ]);
        }
    }
}
