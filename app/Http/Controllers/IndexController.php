<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Country;
use App\Models\CountryPart;

class IndexController extends Controller{

    // show the index page using the blades views 
    public function show_index_front_end(){
      $paises = \App\Models\Country::all()->toArray();
      return view('front.main',['paises' => $paises]);

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

        echo "<a href='/{$countr}'>$country->name</a><br>";

        $country_part = $country->sections()->where('slug', $country_part)->first();

        if (is_null ($country_part) ) {
            abort(403, 'Invalid Country Part.');
        }
        
        foreach ($country_part->destinations as $destination ){
            echo "<a href='/{$countr}/{$country_part->slug}/$destination->slug'>$destination->name</a><br>";
        }
 
    }

    public function show_country_part_destination($country, $country_part, $destination){

        $country = Country::where('slug',$country)->first();
        
        if (is_null ($country) ) {
            abort(403, 'Invalid Country.');
        }

        echo "<a href='/{$country->slug}'>$country->name</a><br>";
        $country_part = $country->sections()->where('slug', $country_part)->first();
        if (is_null ($country_part) ) {
            abort(403, 'Invalid Country Part.');
        }

        $destination = $country_part->destinations()->where('slug', $destination)->first();
        echo "<h1>$destination->name</h1>";
        $hospedajes = $destination->hostings()->get();
        //dd ($hospedajes);

        if (is_null ($destination) ) {
            abort(403, 'Invalid Destination.');
        }

        return '
        <script>
    
        let map_points  ;        
        let uluru;    
        let countries;    
    
        map_points= '. $hospedajes->toJson() .';        
        
      function initMap() {    
    
        const map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: ' . $destination->position_lat  . ', lng: ' . $destination->position_lng  . ' },
          zoom: 13,
        });
    
        const infoWindow = new google.maps.InfoWindow(); 

        map_points.forEach(function (item, index) {
           uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };

           let marker;

            // The marker, positioned at Uluru
            marker = new google.maps.Marker({
              position: uluru,
              title: item.name,
              //label: item.name,
              map: map,
            });

            // Add a click listener for each marker, and set up the info window.
            marker.addListener("click", () => {
                  infoWindow.close();
                  infoWindow.setContent(marker.getTitle());
                  infoWindow.open(marker.getMap(), marker);
                });

          //console.log(item,uluru, index);
        });
      }
      window.onload = initMap;    
    </script>    
    <style>
    
        #map{
            display:block;
            width:100%;
            height:70vh;
            border:1px solid #000;
        }
    </style>
      
      
        <div id="map"></div>
      
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8" ></script>
    
        
        ';


        dd(__METHOD__,$destination,$destination->hostings()->get(),$destination->tours()->get() );

    }


}
