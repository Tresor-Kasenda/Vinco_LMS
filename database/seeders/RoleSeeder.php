<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

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
