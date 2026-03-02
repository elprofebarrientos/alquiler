<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            // Peso
            [
                'name' => 'Kilogramo',
                'code' => 'KG',
                'symbol' => 'kg',
                'description' => 'Unidad de masa equivalente a 1000 gramos',
                'type' => 'weight',
            ],
            [
                'name' => 'Gramo',
                'code' => 'G',
                'symbol' => 'g',
                'description' => 'Unidad de masa',
                'type' => 'weight',
            ],
            [
                'name' => 'Miligramo',
                'code' => 'MG',
                'symbol' => 'mg',
                'description' => 'Milésima parte de un gramo',
                'type' => 'weight',
            ],
            [
                'name' => 'Libra',
                'code' => 'LBS',
                'symbol' => 'lbs',
                'description' => 'Unidad de masa del sistema imperial',
                'type' => 'weight',
            ],
            [
                'name' => 'Onza',
                'code' => 'OZ',
                'symbol' => 'oz',
                'description' => 'Unidad de masa del sistema imperial',
                'type' => 'weight',
            ],
            // Volumen
            [
                'name' => 'Litro',
                'code' => 'L',
                'symbol' => 'L',
                'description' => 'Unidad de volumen equivalente a 1000 ml',
                'type' => 'volume',
            ],
            [
                'name' => 'Mililitro',
                'code' => 'ML',
                'symbol' => 'ml',
                'description' => 'Milésima parte de un litro',
                'type' => 'volume',
            ],
            [
                'name' => 'Galón',
                'code' => 'GAL',
                'symbol' => 'gal',
                'description' => 'Unidad de volumen del sistema imperial',
                'type' => 'volume',
            ],
            [
                'name' => 'Barril',
                'code' => 'BBL',
                'symbol' => 'bbl',
                'description' => 'Unidad de volumen para líquidos',
                'type' => 'volume',
            ],
            [
                'name' => 'Metro cúbico',
                'code' => 'M3',
                'symbol' => 'm³',
                'description' => 'Unidad de volumen en el sistema métrico',
                'type' => 'volume',
            ],
            // Longitud
            [
                'name' => 'Metro',
                'code' => 'M',
                'symbol' => 'm',
                'description' => 'Unidad fundamental de longitud',
                'type' => 'length',
            ],
            [
                'name' => 'Centímetro',
                'code' => 'CM',
                'symbol' => 'cm',
                'description' => 'Centésima parte de un metro',
                'type' => 'length',
            ],
            [
                'name' => 'Milímetro',
                'code' => 'MM',
                'symbol' => 'mm',
                'description' => 'Milésima parte de un metro',
                'type' => 'length',
            ],
            [
                'name' => 'Kilómetro',
                'code' => 'KM',
                'symbol' => 'km',
                'description' => '1000 metros',
                'type' => 'length',
            ],
            [
                'name' => 'Pulgada',
                'code' => 'IN',
                'symbol' => '"',
                'description' => 'Unidad de longitud del sistema imperial',
                'type' => 'length',
            ],
            [
                'name' => 'Pie',
                'code' => 'FT',
                'symbol' => 'ft',
                'description' => 'Unidad de longitud equivalente a 12 pulgadas',
                'type' => 'length',
            ],
            [
                'name' => 'Yarda',
                'code' => 'YD',
                'symbol' => 'yd',
                'description' => 'Unidad de longitud equivalente a 3 pies',
                'type' => 'length',
            ],
            // Área
            [
                'name' => 'Metro cuadrado',
                'code' => 'M2',
                'symbol' => 'm²',
                'description' => 'Unidad de área en el sistema métrico',
                'type' => 'area',
            ],
            [
                'name' => 'Centímetro cuadrado',
                'code' => 'CM2',
                'symbol' => 'cm²',
                'description' => 'Unidad de área pequeña',
                'type' => 'area',
            ],
            [
                'name' => 'Hectárea',
                'code' => 'HA',
                'symbol' => 'ha',
                'description' => '10,000 metros cuadrados',
                'type' => 'area',
            ],
            // Tiempo
            [
                'name' => 'Hora',
                'code' => 'H',
                'symbol' => 'h',
                'description' => 'Unidad de tiempo',
                'type' => 'time',
            ],
            [
                'name' => 'Minuto',
                'code' => 'MIN',
                'symbol' => 'min',
                'description' => '60 segundos',
                'type' => 'time',
            ],
            [
                'name' => 'Segundo',
                'code' => 'S',
                'symbol' => 's',
                'description' => 'Unidad fundamental de tiempo',
                'type' => 'time',
            ],
            [
                'name' => 'Día',
                'code' => 'D',
                'symbol' => 'd',
                'description' => '24 horas',
                'type' => 'time',
            ],
            // Estándar (unidades sin clasificación específica)
            [
                'name' => 'Piezas',
                'code' => 'PCS',
                'symbol' => 'pcs',
                'description' => 'Cantidad de artículos individuales',
                'type' => 'standard',
            ],
            [
                'name' => 'Docena',
                'code' => 'DOZ',
                'symbol' => 'doz',
                'description' => 'Grupo de 12 unidades',
                'type' => 'standard',
            ],
            [
                'name' => 'Caja',
                'code' => 'BOX',
                'symbol' => 'box',
                'description' => 'Cantidad por caja',
                'type' => 'standard',
            ],
            [
                'name' => 'Paquete',
                'code' => 'PKG',
                'symbol' => 'pkg',
                'description' => 'Cantidad por paquete',
                'type' => 'standard',
            ],
            [
                'name' => 'Botella',
                'code' => 'BTL',
                'symbol' => 'btl',
                'description' => 'Cantidad por botella',
                'type' => 'standard',
            ],
            [
                'name' => 'Lata',
                'code' => 'CAN',
                'symbol' => 'can',
                'description' => 'Cantidad por lata',
                'type' => 'standard',
            ],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
