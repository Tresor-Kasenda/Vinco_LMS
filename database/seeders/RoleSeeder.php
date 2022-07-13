<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
