<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategory;
use App\Models\Category;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inmuebles = Category::where('slug', 'inmuebles')->first();
        $vehiculos = Category::where('slug', 'vehiculos')->first();
        $electronica = Category::where('slug', 'electronica')->first();
        $deportes = Category::where('slug', 'equipos-deportivos')->first();
        $herramientas = Category::where('slug', 'herramientas')->first();

        // Subcategorias para Inmuebles
        $apartamentos = Subcategory::create([
            'name' => 'Apartamentos',
            'slug' => 'apartamentos',
            'description' => 'Alquiler de apartamentos y estudios',
            'category_id' => $inmuebles->id,
            'parent_id' => null,
        ]);

        Subcategory::create([
            'name' => 'Apartamentos Amueblados',
            'slug' => 'apartamentos-amueblados',
            'description' => 'Apartamentos completamente amueblados y equipados',
            'category_id' => $inmuebles->id,
            'parent_id' => $apartamentos->id,
        ]);

        Subcategory::create([
            'name' => 'Apartamentos Sin Amueblar',
            'slug' => 'apartamentos-sin-amueblar',
            'description' => 'Apartamentos vacios listos para amueblar',
            'category_id' => $inmuebles->id,
            'parent_id' => $apartamentos->id,
        ]);

        $casas = Subcategory::create([
            'name' => 'Casas',
            'slug' => 'casas',
            'description' => 'Alquiler de casas y viviendas completas',
            'category_id' => $inmuebles->id,
            'parent_id' => null,
        ]);

        Subcategory::create([
            'name' => 'Casas Unifamiliares',
            'slug' => 'casas-unifamiliares',
            'description' => 'Casas de una sola familia',
            'category_id' => $inmuebles->id,
            'parent_id' => $casas->id,
        ]);

        Subcategory::create([
            'name' => 'Locales Comerciales',
            'slug' => 'locales-comerciales',
            'description' => 'Espacios para negocios y comercio',
            'category_id' => $inmuebles->id,
            'parent_id' => null,
        ]);

        // Subcategorias para Vehiculos
        $carros = Subcategory::create([
            'name' => 'Carros',
            'slug' => 'carros',
            'description' => 'Alquiler de automoviles y sedanes',
            'category_id' => $vehiculos->id,
            'parent_id' => null,
        ]);

        Subcategory::create([
            'name' => 'Carros de Lujo',
            'slug' => 'carros-de-lujo',
            'description' => 'Vehiculos de alta gama y lujo',
            'category_id' => $vehiculos->id,
            'parent_id' => $carros->id,
        ]);

        Subcategory::create([
            'name' => 'Carros Economicos',
            'slug' => 'carros-economicos',
            'description' => 'Vehiculos economicos y practicos',
            'category_id' => $vehiculos->id,
            'parent_id' => $carros->id,
        ]);

        Subcategory::create([
            'name' => 'Motos',
            'slug' => 'motos',
            'description' => 'Alquiler de motocicletas',
            'category_id' => $vehiculos->id,
            'parent_id' => null,
        ]);

        // Subcategorias para Electronica
        $smartphones = Subcategory::create([
            'name' => 'Smartphones',
            'slug' => 'smartphones',
            'description' => 'Alquiler de telefonos inteligentes',
            'category_id' => $electronica->id,
            'parent_id' => null,
        ]);

        Subcategory::create([
            'name' => 'iPhones',
            'slug' => 'iphones',
            'description' => 'Alquiler de iPhones de Apple',
            'category_id' => $electronica->id,
            'parent_id' => $smartphones->id,
        ]);

        Subcategory::create([
            'name' => 'Samsung',
            'slug' => 'samsung',
            'description' => 'Alquiler de telefonos Samsung',
            'category_id' => $electronica->id,
            'parent_id' => $smartphones->id,
        ]);

        Subcategory::create([
            'name' => 'Laptops',
            'slug' => 'laptops',
            'description' => 'Alquiler de computadoras portatiles',
            'category_id' => $electronica->id,
            'parent_id' => null,
        ]);

        // Subcategorias para Equipos Deportivos
        Subcategory::create([
            'name' => 'Bicicletas',
            'slug' => 'bicicletas',
            'description' => 'Alquiler de bicicletas',
            'category_id' => $deportes->id,
            'parent_id' => null,
        ]);

        Subcategory::create([
            'name' => 'Patines',
            'slug' => 'patines',
            'description' => 'Alquiler de patines y accesorios',
            'category_id' => $deportes->id,
            'parent_id' => null,
        ]);

        // Subcategorias para Herramientas
        Subcategory::create([
            'name' => 'Herramientas Manuales',
            'slug' => 'herramientas-manuales',
            'description' => 'Alquiler de herramientas de mano',
            'category_id' => $herramientas->id,
            'parent_id' => null,
        ]);

        Subcategory::create([
            'name' => 'Herramientas Electricas',
            'slug' => 'herramientas-electricas',
            'description' => 'Alquiler de herramientas electricas y mecanicas',
            'category_id' => $herramientas->id,
            'parent_id' => null,
        ]);
    }
}
