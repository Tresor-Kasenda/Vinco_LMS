<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

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
            'Comptable'
        ];

        foreach ($roles as $role) {
            Role::query()
                ->create([
                    'name' => $role
                ]);
        }
    }
}
