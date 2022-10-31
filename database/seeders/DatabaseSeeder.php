<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Country::create(['name'=>'Costa Rica']);
        \App\Models\Country::create(['name'=>'Mexico']);
        \App\Models\Country::create(['name'=>'Guatemala']);
        \App\Models\Country::create(['name'=>'Colombia']);
        \App\Models\Country::create(['name'=>'Peru']);
        \App\Models\Country::create(['name'=>'Panama']);
        \App\Models\Country::create(['name'=>'Chile']);
        \App\Models\Country::create(['name'=>'Argentina']);
        \App\Models\Country::create(['name'=>'Brasil']);


        \App\Models\Airline::create(['name'=>'Volaris']);
        \App\Models\Airline::create(['name'=>'Avianca']);
        \App\Models\Airline::create(['name'=>'Latam']);
        \App\Models\Airline::create(['name'=>'Copa']);
        \App\Models\Airline::create(['name'=>'Aeromexico']);
        \App\Models\Airline::create(['name'=>'Wingo']);
        \App\Models\Airline::create(['name'=>'Arajet']);
        \App\Models\Airline::create(['name'=>'American Airlines']);
        \App\Models\Airline::create(['name'=>'Aerolineas Argentinas']);



        \App\Models\HostingFeature::Create(['name'=>'Aire Acondicionado']);
        \App\Models\HostingFeature::Create(['name'=>'Internet Wifi']);
        \App\Models\HostingFeature::Create(['name'=>'Cocina']);
        \App\Models\HostingFeature::Create(['name'=>'Agua Caliente']);
        \App\Models\HostingFeature::Create(['name'=>'Lavadora']);
        \App\Models\HostingFeature::Create(['name'=>'Parqueo']);
        \App\Models\HostingFeature::Create(['name'=>'Piscina']);
        \App\Models\HostingFeature::Create(['name'=>'Incluye Desayuno']);
        \App\Models\HostingFeature::Create(['name'=>'Permito Fumado']);
        \App\Models\HostingFeature::Create(['name'=>'Mascotas Permitidas']);
        \App\Models\HostingFeature::Create(['name'=>'Apto para Discapacitados']);
        \App\Models\HostingFeature::Create(['name'=>'Apto para Menores de Edad']);


        \App\Models\RentACar::Create(['name'=>'Alamo']);
        \App\Models\RentACar::Create(['name'=>'Thirty']);
        \App\Models\RentACar::Create(['name'=>'SixT']);
        \App\Models\RentACar::Create(['name'=>'Budget']);

        

        \App\Models\User::create([
             'name' => 'Admin',
             'email' => 'rodogonzalez@msn.com',             
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         ]);
    }
}
