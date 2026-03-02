<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            // Electrónica
            [
                'name' => 'Samsung',
                'description' => 'Líder global en electrónica y tecnología',
            ],
            [
                'name' => 'Apple',
                'description' => 'Empresa de tecnología conocida por iPhone, iPad y Mac',
            ],
            [
                'name' => 'LG Electronics',
                'description' => 'Fabricante de electrodomésticos y televisores',
            ],
            [
                'name' => 'Sony',
                'description' => 'Compañía japonesa de electrónica y entretenimiento',
            ],
            [
                'name' => 'Dell',
                'description' => 'Fabricante de computadoras y periféricos',
            ],
            // Automoción
            [
                'name' => 'Toyota',
                'description' => 'Constructor automovilístico japonés',
            ],
            [
                'name' => 'Honda',
                'description' => 'Fabricante de automóviles y motocicletas',
            ],
            [
                'name' => 'Hyundai',
                'description' => 'Constructora automovilística coreana',
            ],
            [
                'name' => 'BMW',
                'description' => 'Fabricante de automóviles de lujo alemán',
            ],
            // Deportes y Fitness
            [
                'name' => 'Nike',
                'description' => 'Fabricante de ropa y calzado deportivo',
            ],
            [
                'name' => 'Adidas',
                'description' => 'Empresa alemana de artículos deportivos',
            ],
            [
                'name' => 'Puma',
                'description' => 'Fabricante de ropa y equipo deportivo',
            ],
            // Herramientas y Construcción
            [
                'name' => 'DeWalt',
                'description' => 'Fabricante de herramientas y equipos eléctricos',
            ],
            [
                'name' => 'Bosch',
                'description' => 'Empresa de ingeniería y tecnología alemana',
            ],
            [
                'name' => 'Makita',
                'description' => 'Fabricante de herramientas eléctricas profesionales',
            ],
            // Electrodomésticos
            [
                'name' => 'Whirlpool',
                'description' => 'Fabricante de electrodomésticos',
            ],
            [
                'name' => 'Electrolux',
                'description' => 'Empresa sueca de electrodomésticos',
            ],
            [
                'name' => 'Haier',
                'description' => 'Fabricante chino de electrodomésticos',
            ],
            // Mobiliario
            [
                'name' => 'IKEA',
                'description' => 'Empresa sueca de muebles y decoración',
            ],
            [
                'name' => 'Steelcase',
                'description' => 'Fabricante de muebles de oficina',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
