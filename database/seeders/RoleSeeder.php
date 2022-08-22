<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

final class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Etudiant']);
        Role::create(['name' => 'Parent']);
        Role::create(['name' => 'Gestionnaire']);
        Role::create(['name' => 'Professeur']);
        Role::create(['name' => 'Comptable']);
    }
}
