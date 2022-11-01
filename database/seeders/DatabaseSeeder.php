<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private function create_country_sections($country_id, $list_options){
        
        
        $lista = explode(",",$list_options);
        foreach($lista as $provincia){
            \App\Models\CountryPart::create(['name'=>$provincia, 'countries_id'=> $country_id]);

        }


    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $nuevo_pais = \App\Models\Country::create(['name'=>'Costa Rica']);
        $this->create_country_sections($nuevo_pais->id,  "San Jose,Alajuela,Cartago,Heredia,Puntarenas,Guanacaste,Limon");        


        
        $nuevo_pais =\App\Models\Country::create(['name'=>'Mexico']);        
        $this->create_country_sections($nuevo_pais->id,  "Ciudad Mexico,Quintana Roo,Monterey,Guadalajara,Valladolid,Merica,Veracruz,Tabasco,Acapulco,Oaxaca,Chiapas");        

        $nuevo_pais =\App\Models\Country::create(['name'=>'Guatemala']);

        $this->create_country_sections($nuevo_pais->id,  "Alta Verapaz,Baja Verapaz,Chimaltenago,Chiquimula,Guatemala,El Progreso,Escuintla,Huehuetenango,Izabal,Jalapa,Jutiapa,Petén,Quetzaltenango,Quiché,Retalhuleu,Sacatepequez,San Marcos,Santa Rosa,Sololá,Suchitepequez,Totonicapán,Zacapa");             

        
        $nuevo_pais =\App\Models\Country::create(['name'=>'Colombia']);
        $this->create_country_sections($nuevo_pais->id,  "Amazonas,Antioquia,Arauca,Atlántico,Bogotá,Bolívar,Boyacá,Caldas,Caquetá,Casanare,Cauca,Cesar,Chocó,Córdoba,Cundinamarca,Guainía,Guaviare,Huila,La Guajira,Magdalena,Meta,Nariño,Norte de Santander,Putumayo,Quindío,Risaralda,San Andrés y Providencia,Santander,Sucre,Tolima,Valle del Cauca,Vaupés,Vichada");             
   


        $nuevo_pais =\App\Models\Country::create(['name'=>'Peru']);
        $this->create_country_sections($nuevo_pais->id,  "Amazonas,Ancash,Apurimac,Arequipa,Ayacucho,Cajamarca,Callao,Cusco,Huancavelica,Huanuco,Ica,Junín,La Libertad,Lambayeque,Lima,Loreto,Madre de Dios,Moquegua,Pasco,Piura,Puno,San Martín,Tacna,Tumbes,Ucayali");        

        $nuevo_pais =\App\Models\Country::create(['name'=>'Panama']);
        $this->create_country_sections($nuevo_pais->id,  "Bocas del Toro,Coclé,Colón,Chiriquí,Darién,Herrera,Los Santos,Panamá,Veraguas,Panamá Oeste");
                

        $nuevo_pais =\App\Models\Country::create(['name'=>'Chile']);
        //$this->create_country_sections($nuevo_pais->id,  "");

        $nuevo_pais =\App\Models\Country::create(['name'=>'Argentina']);
        $this->create_country_sections($nuevo_pais->id,  "Buenos Aires,Catamarca,Chaco,Chubut,Córdoba,Corrientes,Entre Ríos,Formosa,Jujuy,La Pampa,La Rioja,Mendoza,Misiones, Neuquén,Río Negro,Salta,San Juan,San Luis,Santa Cruz,Santa Fe,Santiago del Estero,Tierra del Fuego, Antártida e Islas del Atlántico Sur,Tucumán");

        $nuevo_pais =\App\Models\Country::create(['name'=>'Brasil']);
        //$this->create_country_sections($nuevo_pais->id,  "");


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



        //\App\Models\User::factory(200)->create();
        \App\Models\CountryPartsDestination::factory(10)->create();
        \App\Models\HostingProvider::factory(50)->create();


    }
}
