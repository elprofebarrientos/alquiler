<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar los seeders de geolocalización en orden
        $this->call([
            CountrySeeder::class,
            DepartmentSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            UnitSeeder::class,
            BrandSeeder::class,
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
