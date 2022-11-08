<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Country;
use App\Models\CountryPart;

class IndexController extends Controller{
    public function show_index(){

        $puntos = \App\Models\Country::all();

 return ' <script>
    
 let map_points  ;
 
 let uluru;

 let countries;

 countries =  ' . $puntos->toJson() . ' ;


 map_points= [];
function initMap() {


 const map = new google.maps.Map(document.getElementById("map"), {
   center: { lat: 9.9356876, lng: -84.2486378 },
   zoom: 10,
 });

 const infoWindow = new google.maps.InfoWindow();


 countries.forEach(function (item, index) {
    uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };

    let marker;

     // The marker, positioned at Uluru
     marker = new google.maps.Marker({
       position: uluru,
       title: item.slug,       
       
       map: map,
     });

     // Add a click listener for each marker, and set up the info window.
     marker.addListener("click", () => {
           infoWindow.close();
           

           infoWindow.setContent("<a href=\'" + marker.getTitle()  + "\'>" + marker.getTitle()  + "</a>");
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
 

    }

    public function show_country($countr){
        $contry = Country::where('slug',$countr)->first();
        if (is_null ($contry) ) {
            abort(403, 'Invalid Country.');

        }
        echo "<a href='/'>Index</a><br>";

        foreach ($contry->sections as $section ){
          //  echo "<a href='/{$countr->name}/$section->slug'>$section->name :  {$section->destinations()->count()}</a><br>";
        } 





 return ' <script>
    
 let map_points  ;
 
 let uluru;

 let countries;

 countries =  ' . $contry->sections->toJson() . ' ;


 map_points= [];
function initMap() {


 const map = new google.maps.Map(document.getElementById("map"), {
   center: { lat: ' . $contry->position_lat . ', lng: ' . $contry->position_lng . ' },
   zoom: 8,
 });

 const infoWindow = new google.maps.InfoWindow();


 countries.forEach(function (item, index) {
    uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };

    let marker;

     // The marker, positioned at Uluru
     marker = new google.maps.Marker({
       position: uluru,
       title: item.slug,              
       map: map,
     });

     // Add a click listener for each marker, and set up the info window.
     marker.addListener("click", () => {
           infoWindow.close();         

           infoWindow.setContent("<a href=\''. $contry->name .'\" + marker.getTitle()  + "\'>" + marker.getTitle()  + "</a>");

           
           infoWindow.open(marker.getMap(), marker);
         });
   
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

        if (is_null ($destination) ) {
            abort(403, 'Invalid Destination.');
        }


        dd(__METHOD__,$destination,$destination->hostings()->get(),$destination->tours()->get() );

    }


}
