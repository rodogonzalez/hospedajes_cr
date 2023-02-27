<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Country;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

//use App\Models\CountryPart;
//use App\Models\CountryPartsDestination;


class IndexController extends Controller{

    // show the index page using the blades views 
    public function show_index_front_end(){
      $paises = \App\Models\Country::all()->toArray();
      return view('front.main',['paises' => $paises]);

    }

    // show the index page using the blades views 
    public function show_new_host_front_end(Request $request){
  
        if ($request->has('_token')){
            
            $new_host = new \App\Models\HostingProvider([
                'name' =>  $request->input("name"),
                'slug'=> Str::slug($request->input("name"), '-'),
                'country_parts_destinations_id'=>  $request->input("country_part_destinations"), 
                'email' => $request->input("email"),
                'phone_contact' =>  $request->input("phone") ,
                'position_lng' => $request->input("position_lng") ,
                'position_lat' => $request->input("position_lat"),
                'description' => $request->input("desc"),
    
                
                
                
            ]);
            dd($new_host);

        }

        $paises = \App\Models\Country::all();
        return view('front.new_host',['paises' => $paises]);
  
      }

    public function show_country($countr){
        $contry = Country::where('slug',$countr)->first();
        if (is_null ($contry) ) {
            abort(403, 'Invalid Country.');

        }       

        return json_encode($contry->sections);


    }

    public function show_country_part($countr, $country_part){

        $country = Country::where('slug',$countr)->first();
        
        if (is_null ($country) ) {
            abort(403, 'Invalid Country.');
        }

        $country_part = $country->sections()->where('slug', $country_part)->first();

        if (is_null ($country_part) ) {
            abort(403, 'Invalid Country Part.');
        }        
        return json_encode($country_part->destinations);

    }

    public function show_country_part_destination($country, $country_part, $destination){

        $country = Country::where('slug',$country)->first();
        
        if (is_null ($country) ) {
            abort(403, 'Invalid Country.');
        }

        //echo "<a href='/{$country->slug}'>$country->name</a><br>";
        $country_part = $country->sections()->where('slug', $country_part)->first();
        if (is_null ($country_part) ) {
            abort(403, 'Invalid Country Part.');
        }

        $destination = $country_part->destinations()->where('slug', $destination)->first();
        //echo "<h1>$destination->name</h1>";
        $hospedajes = $destination->hostings()->get();


        if (is_null ($destination) ) {
            abort(403, 'Invalid Destination.');
        }

        return json_encode($destination->hostings()->get());
        //dd(__METHOD__,$destination,,$destination->tours()->get() );

    }


}
