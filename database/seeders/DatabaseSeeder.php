<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class DatabaseSeeder extends Seeder
{
    private function get_position_address($address_value){
        $end_point_request = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8&address=" . urlencode($address_value) . "&";        
        $result = json_decode(file_get_contents($end_point_request), true);        
        return $result['results'][0]['geometry']['location'];

    }

    private function create_country_sections($country_id, $list_options){


        $country = \App\Models\Country::where("id",$country_id)->first();
        $location = $this->get_position_address($country->name);
        $country->position_lat = $location['lat'];
        $country->position_lng = $location['lng'];
        $country->save();
        
        $lista = explode(",",$list_options);
        foreach($lista as $provincia){

            $location = $this->get_position_address($country->name . ", $provincia");

            $new_country_part = \App\Models\CountryPart::create([
                                                'name'=>$provincia,
                                                'countries_id'=> $country_id,
                                                'slug'=> Str::slug($provincia, '-') ,
                                                'position_lat' => $location['lat'],
                                                'position_lng' => $location['lng']
                                            ]);

            
            switch(strtolower($provincia)){
                //                                            
                case "san jose":
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'San Jose Centro',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('san jose centro', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'San Pedro',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('san pedro', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Escazu',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug("escazu", '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Sabana',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('sabana', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Coronado',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('coronado', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    break;
                case "alajuela":
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Alajuela Centro',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('alajuela', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Atenas',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('atenas', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Grecia',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('grecia', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'San Ramon',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('san ramon', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'San Carlos',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('san carlos', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    break;
                case "cartago":
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Paraiso',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Paraiso', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Irazu',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Irazu', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Turrialba',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Turrialba', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    break;
                case "puntarenas":
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Puntarenas Centro',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Puntarenas Centro', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Herradura',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Herradura', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Jaco',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Jaco', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Esterillos',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Esterillos', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Manuel Antonio Quepos',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('quepos', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    break;
                case "limon":
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Tortuguero',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('tortuguero', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Cahuita',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('cahuita', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Puerto Viejo',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Puerto Viejo', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Guacimo',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Guacimo', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    break;
                case "guanacaste":
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Liberia',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('liberia', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'El Coco',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('el coco', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Tamarindo',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Tamarindo', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Golfo de Papagayo',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('Golfo de Papagayo', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    break;
                case "heredia":
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Heredia Centro',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('heredia', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Sarapiqui',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('sarapiqui', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    \App\Models\CountryPartsDestination::create([
                        'name'=>'Barba',
                        'country_parts_id'=> $new_country_part->id,
                        'slug'=> Str::slug('barba', '-') ,
                        'position_lat' => $location['lat'],
                        'position_lng' => $location['lng']
                    ]);
                    break;

                case "san jose":
                    break;                    
                case "san jose":
                    break;
                case "san jose":
                    break;
                case "san jose":
                    break;
                case "san jose":
                    break;
            }


        }

        echo "$country->name done \n";
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
/*
        $this->call([
            'netdjw\LoremIpsum\Database\Seeds\LoremIpsumLaSeeder'
        ]);
*/

        \Backpack\PermissionManager\app\Models\Role::create([
            'name' => 'Admin',            
        ]);

        \Backpack\PermissionManager\app\Models\Role::create([
            'name' => 'Visitor',            
        ]);        

        \App\Models\User::create([
             'name' => 'Admin',
             'email' => 'rodogonzalez@msn.com',             
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         ]);

         

        
        $nuevo_pais = \App\Models\Country::create(['name'=>'Costa Rica', 'slug' => 'costa-rica' ]);
        $this->create_country_sections($nuevo_pais->id,  "San Jose,Alajuela,Cartago,Heredia,Puntarenas,Guanacaste,Limon");        

        
/*
        
        $nuevo_pais =\App\Models\Country::create(['name'=>'Mexico', 'slug' => 'mexico' ]);        
        $this->create_country_sections($nuevo_pais->id,  "Ciudad Mexico,Quintana Roo,Monterey,Guadalajara,Valladolid,Merica,Veracruz,Tabasco,Acapulco,Oaxaca,Chiapas");        

        $nuevo_pais =\App\Models\Country::create(['name'=>'Guatemala', 'slug' => 'guatemala' ]);

        $this->create_country_sections($nuevo_pais->id,  "Alta Verapaz,Baja Verapaz,Chimaltenago,Chiquimula,Guatemala,El Progreso,Escuintla,Huehuetenango,Izabal,Jalapa,Jutiapa,Petén,Quetzaltenango,Quiché,Retalhuleu,Sacatepequez,San Marcos,Santa Rosa,Sololá,Suchitepequez,Totonicapán,Zacapa");             

        
        $nuevo_pais =\App\Models\Country::create(['name'=>'Colombia', 'slug' => 'colombia' ]);
        $this->create_country_sections($nuevo_pais->id,  "Amazonas,Antioquia,Arauca,Atlántico,Bogotá,Bolívar,Boyacá,Caldas,Caquetá,Casanare,Cauca,Cesar,Chocó,Córdoba,Cundinamarca,Guainía,Guaviare,Huila,La Guajira,Magdalena,Meta,Nariño,Norte de Santander,Putumayo,Quindío,Risaralda,San Andrés y Providencia,Santander,Sucre,Tolima,Valle del Cauca,Vaupés,Vichada");             
   


        $nuevo_pais =\App\Models\Country::create(['name'=>'Peru', 'slug' => 'peru' ]);
        $this->create_country_sections($nuevo_pais->id,  "Amazonas,Ancash,Apurimac,Arequipa,Ayacucho,Cajamarca,Callao,Cusco,Huancavelica,Huanuco,Ica,Junín,La Libertad,Lambayeque,Lima,Loreto,Madre de Dios,Moquegua,Pasco,Piura,Puno,San Martín,Tacna,Tumbes,Ucayali");        

        $nuevo_pais =\App\Models\Country::create(['name'=>'Panama', 'slug' => 'panama' ]);
        $this->create_country_sections($nuevo_pais->id,  "Bocas del Toro,Coclé,Colón,Chiriquí,Darién,Herrera,Los Santos,Panamá,Veraguas,Panamá Oeste");
                

        //$nuevo_pais =\App\Models\Country::create(['name'=>'Chile', 'slug' => 'chile' ]);
        //$this->create_country_sections($nuevo_pais->id,  "");

        $nuevo_pais =\App\Models\Country::create(['name'=>'Argentina', 'slug' => 'argentina' ]);
        $this->create_country_sections($nuevo_pais->id,  "Buenos Aires,Catamarca,Chaco,Chubut,Córdoba,Corrientes,Entre Ríos,Formosa,Jujuy,La Pampa,La Rioja,Mendoza,Misiones, Neuquén,Río Negro,Salta,San Juan,San Luis,Santa Cruz,Santa Fe,Santiago del Estero,Tierra del Fuego, Antártida e Islas del Atlántico Sur,Tucumán");

        $nuevo_pais =\App\Models\Country::create(['name'=>'Brasil', 'slug' => 'brasil' ]);
        $this->create_country_sections($nuevo_pais->id,  "Sau Paulo,Rio de Janeiro");

        $nuevo_pais =\App\Models\Country::create(['name'=>'Bolivia', 'slug' => 'bolivia' ]);
        $this->create_country_sections($nuevo_pais->id,  "Sucre,La Paz");

        $nuevo_pais =\App\Models\Country::create(['name'=>'Nicaragua', 'slug' => 'nicaragua' ]);
        $this->create_country_sections($nuevo_pais->id,  "Managua,San Juan,Rivas,Masaya,Leon");


        $nuevo_pais =\App\Models\Country::create(['name'=>'Ecuador', 'slug' => 'ecuador' ]);
        $this->create_country_sections($nuevo_pais->id,  "Quito,Guayaquil,Galapagos");


        $nuevo_pais =\App\Models\Country::create(['name'=>'Uruguay', 'slug' => 'Uruguay' ]);
        $this->create_country_sections($nuevo_pais->id,  "Montevideo");

        $nuevo_pais =\App\Models\Country::create(['name'=>'Jamaica', 'slug' => 'Jamaica' ]);
        $this->create_country_sections($nuevo_pais->id,  "Kingston");


        //$this->create_country_sections($nuevo_pais->id,  "");

*/
        \App\Models\Airline::create(['name'=>'Volaris', 'slug' => 'volaris' ]);
        \App\Models\Airline::create(['name'=>'Avianca', 'slug' => 'avianca' ]);
        \App\Models\Airline::create(['name'=>'Latam', 'slug' => 'latam' ]);
        \App\Models\Airline::create(['name'=>'Copa', 'slug' => 'copa' ]);
        \App\Models\Airline::create(['name'=>'Aeromexico', 'slug' => 'aeromexico' ]);
        \App\Models\Airline::create(['name'=>'Wingo', 'slug' => 'wingo' ]);
        \App\Models\Airline::create(['name'=>'Arajet', 'slug' => 'ara-jet' ]);
        \App\Models\Airline::create(['name'=>'American Airlines', 'slug' => 'american-airlines' ]);
        \App\Models\Airline::create(['name'=>'Aerolineas Argentinas', 'slug' => 'aerolineas-argentinas' ]);
        echo ("Airlines done \n");


        \App\Models\HostingFeature::Create(['name'=>'Aire Acondicionado', 'slug' => 'aire-acondicionado' ]);
        \App\Models\HostingFeature::Create(['name'=>'Internet Wifi', 'slug' => 'wifi' ]);
        \App\Models\HostingFeature::Create(['name'=>'Cocina', 'slug' => 'cocina' ]);
        \App\Models\HostingFeature::Create(['name'=>'Agua Caliente', 'slug' => 'agua-caliente' ]);
        \App\Models\HostingFeature::Create(['name'=>'Lavadora', 'slug' => 'lavadora' ]);
        \App\Models\HostingFeature::Create(['name'=>'Parqueo', 'slug' => 'parqueo' ]);
        \App\Models\HostingFeature::Create(['name'=>'Piscina', 'slug' => 'piscina' ]);
        \App\Models\HostingFeature::Create(['name'=>'Incluye Desayuno', 'slug' => 'incluye-desayuno' ]);
        \App\Models\HostingFeature::Create(['name'=>'Permito Fumado', 'slug' => 'fumado' ]);
        \App\Models\HostingFeature::Create(['name'=>'Mascotas Permitidas', 'slug' => 'mascotas' ]);
        \App\Models\HostingFeature::Create(['name'=>'Apto para Discapacitados', 'slug' => 'discapacitados' ]);
        \App\Models\HostingFeature::Create(['name'=>'Apto para Menores de Edad', 'slug' => 'menores-edad' ]);

        echo ("Hosting Features done \n");


        \App\Models\RentACar::Create(['name'=>'Alamo', 'slug' => 'alamo' ]);
        \App\Models\RentACar::Create(['name'=>'Thirty', 'slug' => 'thirty' ]);
        \App\Models\RentACar::Create(['name'=>'SixT', 'slug' => 'sixty' ]);
        \App\Models\RentACar::Create(['name'=>'Budget', 'slug' => 'budget' ]);



        //\App\Models\User::factory(200)->create();
        //echo ("Creating Random Destinations \n");
        //\App\Models\CountryPartsDestination::factory(50)->create();
        //echo ("Creating Random Hosting 1/10\n");
        //\App\Models\HostingProvider::factory(10)->create();
        
        

    }
}
