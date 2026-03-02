<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            // Argentina - Buenos Aires
            ['department' => 'Buenos Aires', 'country' => 'Argentina', 'name' => 'La Plata'],
            ['department' => 'Buenos Aires', 'country' => 'Argentina', 'name' => 'Quilmes'],
            ['department' => 'Buenos Aires', 'country' => 'Argentina', 'name' => 'Lomas de Zamora'],
            ['department' => 'Buenos Aires', 'country' => 'Argentina', 'name' => 'Avellaneda'],
            ['department' => 'Buenos Aires', 'country' => 'Argentina', 'name' => 'San Isidro'],
            // Córdoba
            ['department' => 'Córdoba', 'country' => 'Argentina', 'name' => 'Córdoba'],
            ['department' => 'Córdoba', 'country' => 'Argentina', 'name' => 'Río Cuarto'],
            // Bolivia - La Paz
            ['department' => 'La Paz', 'country' => 'Bolivia', 'name' => 'La Paz'],
            ['department' => 'La Paz', 'country' => 'Bolivia', 'name' => 'El Alto'],
            // Cochabamba
            ['department' => 'Cochabamba', 'country' => 'Bolivia', 'name' => 'Cochabamba'],
            ['department' => 'Cochabamba', 'country' => 'Bolivia', 'name' => 'Quillacollo'],
            // Santa Cruz
            ['department' => 'Santa Cruz', 'country' => 'Bolivia', 'name' => 'Santa Cruz de la Sierra'],
            ['department' => 'Santa Cruz', 'country' => 'Bolivia', 'name' => 'San Ignacio de Velasco'],
            // Brasil - São Paulo
            ['department' => 'São Paulo', 'country' => 'Brasil', 'name' => 'São Paulo'],
            ['department' => 'São Paulo', 'country' => 'Brasil', 'name' => 'Campinas'],
            ['department' => 'São Paulo', 'country' => 'Brasil', 'name' => 'Santos'],
            ['department' => 'São Paulo', 'country' => 'Brasil', 'name' => 'Guarulhos'],
            // Rio de Janeiro
            ['department' => 'Rio de Janeiro', 'country' => 'Brasil', 'name' => 'Rio de Janeiro'],
            ['department' => 'Rio de Janeiro', 'country' => 'Brasil', 'name' => 'Niterói'],
            ['department' => 'Rio de Janeiro', 'country' => 'Brasil', 'name' => 'Duque de Caxias'],
            // Minas Gerais
            ['department' => 'Minas Gerais', 'country' => 'Brasil', 'name' => 'Belo Horizonte'],
            ['department' => 'Minas Gerais', 'country' => 'Brasil', 'name' => 'Uberlândia'],
            // Bahia
            ['department' => 'Bahia', 'country' => 'Brasil', 'name' => 'Salvador'],
            ['department' => 'Bahia', 'country' => 'Brasil', 'name' => 'Feira de Santana'],
            // Chile - Metropolitana de Santiago
            ['department' => 'Metropolitana de Santiago', 'country' => 'Chile', 'name' => 'Santiago'],
            ['department' => 'Metropolitana de Santiago', 'country' => 'Chile', 'name' => 'Ñuñoa'],
            ['department' => 'Metropolitana de Santiago', 'country' => 'Chile', 'name' => 'Las Condes'],
            ['department' => 'Metropolitana de Santiago', 'country' => 'Chile', 'name' => 'Puente Alto'],
            // Valparaíso
            ['department' => 'Valparaíso', 'country' => 'Chile', 'name' => 'Valparaíso'],
            ['department' => 'Valparaíso', 'country' => 'Chile', 'name' => 'Viña del Mar'],
            // Bío Bío
            ['department' => 'Biobío', 'country' => 'Chile', 'name' => 'Concepción'],
            ['department' => 'Biobío', 'country' => 'Chile', 'name' => 'Los Ángeles'],
            // Colombia - Bogotá
            ['department' => 'Distrito Capital de Bogotá', 'country' => 'Colombia', 'name' => 'Bogotá'],
            ['department' => 'Distrito Capital de Bogotá', 'country' => 'Colombia', 'name' => 'Usaquén'],
            ['department' => 'Distrito Capital de Bogotá', 'country' => 'Colombia', 'name' => 'Chapinero'],
            // Antioquia
            ['department' => 'Antioquia', 'country' => 'Colombia', 'name' => 'Medellín'],
            ['department' => 'Antioquia', 'country' => 'Colombia', 'name' => 'Envigado'],
            ['department' => 'Antioquia', 'country' => 'Colombia', 'name' => 'Manizales'],
            // Cundinamarca
            ['department' => 'Cundinamarca', 'country' => 'Colombia', 'name' => 'Zipaquirá'],
            ['department' => 'Cundinamarca', 'country' => 'Colombia', 'name' => 'Girardot'],
            // Valle del Cauca
            ['department' => 'Valle del Cauca', 'country' => 'Colombia', 'name' => 'Cali'],
            ['department' => 'Valle del Cauca', 'country' => 'Colombia', 'name' => 'Palmira'],
            // Costa Rica - San José
            ['department' => 'San José', 'country' => 'Costa Rica', 'name' => 'San José'],
            ['department' => 'San José', 'country' => 'Costa Rica', 'name' => 'Desamparados'],
            // Alajuela
            ['department' => 'Alajuela', 'country' => 'Costa Rica', 'name' => 'Alajuela'],
            ['department' => 'Alajuela', 'country' => 'Costa Rica', 'name' => 'San Ramón'],
            // Limón
            ['department' => 'Limón', 'country' => 'Costa Rica', 'name' => 'Limón'],
            ['department' => 'Limón', 'country' => 'Costa Rica', 'name' => 'Puerto Limón'],
            // Cuba - La Habana
            ['department' => 'La Habana', 'country' => 'Cuba', 'name' => 'La Habana Vieja'],
            ['department' => 'La Habana', 'country' => 'Cuba', 'name' => 'Centro Habana'],
            ['department' => 'La Habana', 'country' => 'Cuba', 'name' => 'Vedado'],
            // Santiago de Cuba
            ['department' => 'Santiago de Cuba', 'country' => 'Cuba', 'name' => 'Santiago de Cuba'],
            // Ecuador - Pichincha
            ['department' => 'Pichincha', 'country' => 'Ecuador', 'name' => 'Quito'],
            ['department' => 'Pichincha', 'country' => 'Ecuador', 'name' => 'Cayambe'],
            // Guayas
            ['department' => 'Guayas', 'country' => 'Ecuador', 'name' => 'Guayaquil'],
            ['department' => 'Guayas', 'country' => 'Ecuador', 'name' => 'Durán'],
            // Azuay
            ['department' => 'Azuay', 'country' => 'Ecuador', 'name' => 'Cuenca'],
            // El Salvador - San Salvador
            ['department' => 'San Salvador', 'country' => 'El Salvador', 'name' => 'San Salvador'],
            ['department' => 'San Salvador', 'country' => 'El Salvador', 'name' => 'Apopa'],
            // La Libertad
            ['department' => 'La Libertad', 'country' => 'El Salvador', 'name' => 'Santa Tecla'],
            ['department' => 'La Libertad', 'country' => 'El Salvador', 'name' => 'Nueva San Salvador'],
            // Guatemala - Guatemala
            ['department' => 'Guatemala', 'country' => 'Guatemala', 'name' => 'Ciudad de Guatemala'],
            ['department' => 'Guatemala', 'country' => 'Guatemala', 'name' => 'Mixco'],
            ['department' => 'Guatemala', 'country' => 'Guatemala', 'name' => 'Villa Nueva'],
            // Sacatepéquez
            ['department' => 'Sacatepéquez', 'country' => 'Guatemala', 'name' => 'Antigua Guatemala'],
            // Honduras - Cortés
            ['department' => 'Cortés', 'country' => 'Honduras', 'name' => 'San Pedro Sula'],
            ['department' => 'Cortés', 'country' => 'Honduras', 'name' => 'Puerto Cortés'],
            // Francisco Morazán
            ['department' => 'Francisco Morazán', 'country' => 'Honduras', 'name' => 'Tegucigalpa'],
            ['department' => 'Francisco Morazán', 'country' => 'Honduras', 'name' => 'Comayagüela'],
            // México - Ciudad de México
            ['department' => 'Ciudad de México', 'country' => 'México', 'name' => 'México'],
            ['department' => 'Ciudad de México', 'country' => 'México', 'name' => 'Benito Juárez'],
            ['department' => 'Ciudad de México', 'country' => 'México', 'name' => 'Miguel Hidalgo'],
            // Estado de México
            ['department' => 'Estado de México', 'country' => 'México', 'name' => 'Toluca'],
            ['department' => 'Estado de México', 'country' => 'México', 'name' => 'Ecatepec de Morelos'],
            ['department' => 'Estado de México', 'country' => 'México', 'name' => 'Naucalpan de Juárez'],
            // Jalisco
            ['department' => 'Jalisco', 'country' => 'México', 'name' => 'Guadalajara'],
            ['department' => 'Jalisco', 'country' => 'México', 'name' => 'Zapopan'],
            ['department' => 'Jalisco', 'country' => 'México', 'name' => 'Tlaquepaque'],
            // Nuevo León
            ['department' => 'Nuevo León', 'country' => 'México', 'name' => 'Monterrey'],
            ['department' => 'Nuevo León', 'country' => 'México', 'name' => 'San Pedro Garza García'],
            // Veracruz
            ['department' => 'Veracruz', 'country' => 'México', 'name' => 'Veracruz de Ignacio de la Llave'],
            ['department' => 'Veracruz', 'country' => 'México', 'name' => 'Xalapa-Enríquez'],
            // Nicaragua - Managua
            ['department' => 'Managua', 'country' => 'Nicaragua', 'name' => 'Managua'],
            ['department' => 'Managua', 'country' => 'Nicaragua', 'name' => 'Distrito 1'],
            // León
            ['department' => 'León', 'country' => 'Nicaragua', 'name' => 'León'],
            // Granada
            ['department' => 'Granada', 'country' => 'Nicaragua', 'name' => 'Granada'],
            // Panamá - Panamá
            ['department' => 'Panamá', 'country' => 'Panamá', 'name' => 'Panamá'],
            ['department' => 'Panamá', 'country' => 'Panamá', 'name' => 'San Miguelito'],
            ['department' => 'Panamá', 'country' => 'Panamá', 'name' => 'La Chorrera'],
            // Colón
            ['department' => 'Colón', 'country' => 'Panamá', 'name' => 'Colón'],
            ['department' => 'Colón', 'country' => 'Panamá', 'name' => 'Cristóbal'],
            // Paraguay - Asunción
            ['department' => 'Asunción', 'country' => 'Paraguay', 'name' => 'Asunción'],
            // Alto Paraná
            ['department' => 'Alto Paraná', 'country' => 'Paraguay', 'name' => 'Ciudad del Este'],
            ['department' => 'Alto Paraná', 'country' => 'Paraguay', 'name' => 'Hernandarias'],
            // Itapúa
            ['department' => 'Itapúa', 'country' => 'Paraguay', 'name' => 'Encarnación'],
            // Perú - Limá
            ['department' => 'Limá', 'country' => 'Perú', 'name' => 'Lima'],
            ['department' => 'Limá', 'country' => 'Perú', 'name' => 'San Isidro'],
            ['department' => 'Limá', 'country' => 'Perú', 'name' => 'Miraflores'],
            // Cusco
            ['department' => 'Cusco', 'country' => 'Perú', 'name' => 'Cusco'],
            // Arequipa
            ['department' => 'Arequipa', 'country' => 'Perú', 'name' => 'Arequipa'],
            // La Libertad
            ['department' => 'La Libertad', 'country' => 'Perú', 'name' => 'Trujillo'],
            // República Dominicana - Distrito Nacional
            ['department' => 'Distrito Nacional', 'country' => 'República Dominicana', 'name' => 'Santo Domingo'],
            ['department' => 'Distrito Nacional', 'country' => 'República Dominicana', 'name' => 'Santo Domingo Este'],
            // Santiago
            ['department' => 'Santiago', 'country' => 'República Dominicana', 'name' => 'Santiago de los Caballeros'],
            // La Romana
            ['department' => 'La Romana', 'country' => 'República Dominicana', 'name' => 'La Romana'],
            // Uruguay - Montevideo
            ['department' => 'Montevideo', 'country' => 'Uruguay', 'name' => 'Montevideo'],
            ['department' => 'Montevideo', 'country' => 'Uruguay', 'name' => 'Ciudad Vieja'],
            // Canelones
            ['department' => 'Canelones', 'country' => 'Uruguay', 'name' => 'Canelones'],
            // Venezuela - Miranda
            ['department' => 'Miranda', 'country' => 'Venezuela', 'name' => 'Caracas'],
            ['department' => 'Miranda', 'country' => 'Venezuela', 'name' => 'Los Teques'],
            // Zulia
            ['department' => 'Zulia', 'country' => 'Venezuela', 'name' => 'Maracaibo'],
            ['department' => 'Zulia', 'country' => 'Venezuela', 'name' => 'Cabimas'],
            // Carabobo
            ['department' => 'Carabobo', 'country' => 'Venezuela', 'name' => 'Valencia'],
        ];

        foreach ($cities as $cityData) {
            $department = Department::whereHas('country', function ($query) use ($cityData) {
                $query->where('name', $cityData['country']);
            })->where('name', $cityData['department'])->first();

            if ($department) {
                City::create([
                    'name' => $cityData['name'],
                    'department_id' => $department->id,
                ]);
            }
        }
    }
}
