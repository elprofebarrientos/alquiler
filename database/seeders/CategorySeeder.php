<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Inmuebles',
                'slug' => 'inmuebles',
                'description' => 'Alquiler de inmuebles, casas, apartamentos, locales comerciales y terrenos',
                'icon' => 'bx bx-home',
            ],
            [
                'name' => 'Vehiculos',
                'slug' => 'vehiculos',
                'description' => 'Alquiler de vehiculos, carros, motos, bicicletas y otros medios de transporte',
                'icon' => 'bx bx-car',
            ],
            [
                'name' => 'Electronica',
                'slug' => 'electronica',
                'description' => 'Alquiler de dispositivos electronicos, telefonos, laptops, tablets y accesorios',
                'icon' => 'bx bx-mobile-alt',
            ],
            [
                'name' => 'Equipos Deportivos',
                'slug' => 'equipos-deportivos',
                'description' => 'Alquiler de equipos y articulos deportivos para diversas actividades',
                'icon' => 'bx bx-basketball',
            ],
            [
                'name' => 'Herramientas',
                'slug' => 'herramientas',
                'description' => 'Alquiler de herramientas y equipos para construccion y reparacion',
                'icon' => 'bx bx-wrench',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
