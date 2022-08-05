<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Seeder;

final class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Institution::query()
            ->create([
                'institution_name' => 'Vinco',
                'institution_address' => '269, Kasongo NYEMBO, Q/ Baudouin, Lubumbashi',
                'institution_country' => 'Congo DR',
                'institution_phones' => '+243818045132',
                'institution_town' => 'Lubumbashi',
                'institution_images' => asset('assets/favicon.svg'),
                'institution_website' => 'https://www.vinco.digital',
                'institution_description' => '',
            ]);
    }
}
