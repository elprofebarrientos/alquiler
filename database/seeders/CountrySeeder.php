<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Argentina', 'code' => 'AR'],
            ['name' => 'Bolivia', 'code' => 'BO'],
            ['name' => 'Brasil', 'code' => 'BR'],
            ['name' => 'Chile', 'code' => 'CL'],
            ['name' => 'Colombia', 'code' => 'CO'],
            ['name' => 'Costa Rica', 'code' => 'CR'],
            ['name' => 'Cuba', 'code' => 'CU'],
            ['name' => 'Ecuador', 'code' => 'EC'],
            ['name' => 'El Salvador', 'code' => 'SV'],
            ['name' => 'Guatemala', 'code' => 'GT'],
            ['name' => 'Honduras', 'code' => 'HN'],
            ['name' => 'México', 'code' => 'MX'],
            ['name' => 'Nicaragua', 'code' => 'NI'],
            ['name' => 'Panamá', 'code' => 'PA'],
            ['name' => 'Paraguay', 'code' => 'PY'],
            ['name' => 'Perú', 'code' => 'PE'],
            ['name' => 'República Dominicana', 'code' => 'DO'],
            ['name' => 'Uruguay', 'code' => 'UY'],
            ['name' => 'Venezuela', 'code' => 'VE'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
