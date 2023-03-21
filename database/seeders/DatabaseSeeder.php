<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
//use Illuminate\Console\Command;
//use Symfony\Component\Console\Output\ConsoleOutput;


class DatabaseSeeder extends Seeder
{
    private function get_position_address($address_value){
        $end_point_request = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8&address=" . urlencode($address_value) . "&";        
        $result = json_decode(file_get_contents($end_point_request), true);        
        return $result['results'][0]['geometry']['location'];

    }

    private function create_point_location($name, $address, $country_pard_id ){

        $location = $this->get_position_address($name . ", ".  $address);

        \App\Models\CountryPartsDestination::create([
            'name'=>$name,
            'country_parts_id'=> $country_pard_id,
            'slug'=> Str::slug($name, '-') ,
            'position_lat' => $location['lat'],
            'position_lng' => $location['lng']
        ]);

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

                    $this->create_point_location("Morazan", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Sabana", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Plaza de La Cultura", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Escazu", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Coronado", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Moravia", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Curridabat", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Curridabat", "{$provincia}, {$country->name}" , $new_country_part->id );
                    
                    
                    break;
                case "alajuela":
                    $this->create_point_location("Aeropuerto", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("La Garita", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Atenas", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Grecia", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("San Ramon", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("San Carlos", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Upala", "{$provincia}, {$country->name}" , $new_country_part->id );
                    
                    break;
                case "cartago":
                    
                    $this->create_point_location("Turrialba", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Cartago", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Irazu", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Paraiso", "{$provincia}, {$country->name}" , $new_country_part->id );

                    break;
                case "puntarenas":
                    $this->create_point_location("Jaco", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Puntarenas", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Herradura", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Esterillos", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Quepos", "{$provincia}, {$country->name}" , $new_country_part->id );
                    
                    break;
                case "limon":
                    $this->create_point_location("Puerto Viejo", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Cahuita", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Tortuguero", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Guacimo", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Guapiles", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "guanacaste":
                    $this->create_point_location("Liberia", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Bagaces", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Cañas", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Tilaran", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "heredia":
                    $this->create_point_location("Sarapiqui", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Barba", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Santo Domingo", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;

                // mexico

                case "ciudad mexico":
                    $this->create_point_location("Zocalo", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Reforma", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Teotihuacan", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Bosque de Chapultepeq", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;                    
                case "quintana roo":
                    $this->create_point_location("Cancun", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Playa del Carmen", "{$provincia}, {$country->name}" , $new_country_part->id );
                    
                    break;                    
                
                case "valladolid":
                    $this->create_point_location("Valladolid", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;                    
                case "merida":
                    $this->create_point_location("Merida", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Progreso", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;                    
                case "veracruz":
                    break;                    
                case "acapulco":
                    break;                    
                case "oaxaca":
                    $this->create_point_location("Oaxaca de Juarez", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Huatulco", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;                    
                case "chiapas":
                    $this->create_point_location("San Cristobal de las Casas", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Tuxla Gutierrez", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;                    
                    
                // guatemala 
                //,Baja Verapaz,Chimaltenago,Chiquimula,Guatemala,El Progreso,Escuintla,Huehuetenango,Izabal,Jalapa,Jutiapa,Petén,Quetzaltenango,Quiché,Retalhuleu,Sacatepequez,San Marcos,Santa Rosa,Sololá,Suchitepequez,Totonicapán,Zacapa
                case "verapaz":
                    $this->create_point_location("Coban", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Semuc Champey", "{$provincia}, {$country->name}" , $new_country_part->id );

                    break;
                case "guatemala":
                    $this->create_point_location("Antigua", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Aeropuerto Aurora", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "petén":
                    $this->create_point_location("Flores", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Tikal", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "sololá":
                    $this->create_point_location("Panajachel", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("San Juan", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "sacatepequez":
                    break;
                case "izabal":
                    $this->create_point_location("Rio Dulce", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "quetzaltenango":
                    break;
                    
                //peru
                case "cusco":
                    $this->create_point_location("cusco", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("aguas calientes", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("ollantaytambo", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("hidroelectrica", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;

                case "lima":
                    $this->create_point_location("miraflores", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("san isidro", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("san borja", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "ica":
                    $this->create_point_location("paracas", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Huacachina", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "arequipa":
                    $this->create_point_location("Arequipa", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "piura":
                    $this->create_point_location("mancora", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("organos", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "bogotá":
                    $this->create_point_location("bogotá", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("chapinero", "{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("uzaquem", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "medellin":
                    $this->create_point_location("medellin", "{$provincia}, {$country->name}" , $new_country_part->id );
                    break;

                case "bocas del toro":
                    $this->create_point_location("Isla Colon","{$provincia}, {$country->name}" , $new_country_part->id );
                    break;
                case "panamá":
                    $this->create_point_location("Panamá","{$provincia}, {$country->name}" , $new_country_part->id );
                    $this->create_point_location("Casco Antiguo", "{$provincia}, {$country->name}" , $new_country_part->id );
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

        $user = \App\Models\User::create([
             'name' => 'Admin',
             'email' => 'rodogonzalez@msn.com',             
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         ]);

         $user->assignRole('Admin');


        
        $nuevo_pais = \App\Models\Country::create(['name'=>'Costa Rica', 'slug' => 'costa-rica' ]);
        $this->create_country_sections($nuevo_pais->id,  "San Jose,Alajuela,Cartago,Heredia,Puntarenas,Guanacaste,Limon");        

        

        $nuevo_pais =\App\Models\Country::create(['name'=>'Mexico', 'slug' => 'mexico' ]);        
        $this->create_country_sections($nuevo_pais->id,  "Ciudad Mexico,Quintana Roo,Monterey,Guadalajara,Valladolid,Merica,Veracruz,Acapulco,Oaxaca,Chiapas");        

        $nuevo_pais =\App\Models\Country::create(['name'=>'Guatemala', 'slug' => 'guatemala' ]);
        $this->create_country_sections($nuevo_pais->id,  "Verapaz,Chimaltenago,Chiquimula,Guatemala,El Progreso,Escuintla,Huehuetenango,Izabal,Jalapa,Jutiapa,Petén,Quetzaltenango,Quiché,Retalhuleu,Sacatepequez,San Marcos,Santa Rosa,Sololá,Suchitepequez,Totonicapán,Zacapa");             

        $nuevo_pais =\App\Models\Country::create(['name'=>'Peru', 'slug' => 'peru' ]);
        $this->create_country_sections($nuevo_pais->id,  "Lima,Amazonas,Ancash,Apurimac,Arequipa,Ayacucho,Cajamarca,Callao,Cusco,Huancavelica,Huanuco,Ica,Junín,La Libertad,Lambayeque,Loreto,Madre de Dios,Moquegua,Pasco,Piura,Puno,San Martín,Tacna,Tumbes,Ucayali");        

        $nuevo_pais =\App\Models\Country::create(['name'=>'Colombia', 'slug' => 'colombia' ]);
        $this->create_country_sections($nuevo_pais->id,  "Bogotá,Amazonas,Antioquia,Arauca,Atlántico,Bolívar,Boyacá,Caldas,Caquetá,Casanare,Cauca,Cesar,Chocó,Córdoba,Cundinamarca,Guainía,Guaviare,Huila,La Guajira,Magdalena,Meta,Nariño,Norte de Santander,Putumayo,Quindío,Risaralda,San Andrés y Providencia,Santander,Sucre,Tolima,Valle del Cauca,Vaupés,Vichada");             

        $nuevo_pais =\App\Models\Country::create(['name'=>'Panama', 'slug' => 'panama' ]);
        $this->create_country_sections($nuevo_pais->id,  "Bocas del Toro,Coclé,Colón,Chiriquí,Darién,Herrera,Los Santos,Panamá,Veraguas,Panamá Oeste");


/*        
        
   


        

                

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
        // \App\Models\CountryPartsDestination::factory(50)->create();
        //echo ("Creating Random Hosting 1/10\n");

        $total=500;
        
        
        for ($x=0; $x<=$total; $x++) {
            \App\Models\HostingProvider::factory(1)->create();
            echo ("Creating Random Hosting $x  / $total\n");                    
        }
        
    }
}
