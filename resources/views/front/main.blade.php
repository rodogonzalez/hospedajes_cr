@extends(backpack_view('blank'))


@section('content')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8" ></script>
<div class="container">
  <style>

#map{
    display:block;
    width:100%;
    height:70vh;
    border:1px solid #000;
}
</style>

<div id="map"></div>



@if (env('ADSENSE_ENABLED')==true)

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<!-- ads_Side -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3258144106657369"
     data-ad-slot="8812111908"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>

<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
	</script>


@endif



<script>
    

 let map_points  ; 
 let uluru;
 let current_country_part ;
  
 let countries = {{ Illuminate\Support\Js::from($paises) }};


 uluru = { lat: parseFloat(countries[0].position_lat), lng: parseFloat(countries[0].position_lng) };


 const map = new google.maps.Map(document.getElementById("map"), {
   center: uluru,
   zoom: 2,
 });


 const infoWindow = new google.maps.InfoWindow();


    
 const iconBase =
    "/assets/room-icon.svg";
  const icons = {
    parking: {
      icon: iconBase ,// + "beachflag.png",
    },
    library: {
      icon: iconBase ,// + "library_maps.png",
    },
    info: {
      icon: iconBase ,//+ "info-i_maps.png",
    },

  };

 

 map_points= [];

function getCountryPartLocation(slug){

  current_country_part.forEach(function (item, index) {

    uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };

    if (slug==item.slug ){      
      map.setCenter( uluru );
      map.setZoom(13);      
    }

    });
} 

function getCountryLocation(slug){

  countries.forEach(function (item, index) {

    uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };

    if (slug==item.slug ){      
      map.setCenter( uluru );
      map.setZoom(3);      
    }  
  });
}

function pull_country_parts(country_slug){

  getCountryLocation(country_slug);
  
  let options_content = "";

  document.getElementById("country_part").innerHTML = "<option>cargando...</option>";

  // Solicitud GET (Request).
  fetch('/data/' + country_slug)
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {

        current_country_part = result;
    
        result.forEach(function (item, index) {

          uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };
          let point_marker;

          options_content= options_content + "<option value='" +  item.slug + "'>" +  item.slug + "</option>";

          // The marker, positioned at Uluru
          point_marker = new google.maps.Marker({
            position: uluru,
            title: item.slug,
            map: map,
            //,
          });

//          pull_country_parts_destinations(country_slug,item.slug);

          // Add a click listener for each marker, and set up the info window.
          point_marker.addListener("click", () => {                              
              pull_country_parts_destinations(country_slug ,  item.slug);                
              });              
        });

        document.getElementById("country_part").options.length = 0;        
        document.getElementById("country_part").innerHTML = options_content;
      })    
      //imprimir los datos en la consola
      .catch(err => console.log('Solicitud fallida', err)); // Capturar errores
      
}



function pull_all_destinations_commerces(){

fetch('/data/all-commerces')
    // Exito
    .then(response => response.json())  // convertir a json
    .then(result => {

      //console.log(result);
      result.forEach(function (item, index) {

        uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };
        let host_point_marker;
        console.log(item);

        // The marker, positioned at Uluru
        host_point_marker = new google.maps.Marker({
          position: uluru,
          title: item.name,
          map: map,
          icon: icons['parking'].icon,
          //icon:svgMarkerHosting
        });

        let description =  "<hr><b>Descripcion:</b><div>" + item.description + "</div>" ;

        if (description == null ) description = "";


        let hotel_name = "<a href='/admin/hosting-provider/" + item.id + "/edit'>" + item.name + "</a><span>" +  description  + "</span>";

        // Add a click listener for each marker, and set up the info window.
        host_point_marker.addListener("click", () => {

              infoWindow.close();                
              infoWindow.setContent( hotel_name  );
              infoWindow.open(map, host_point_marker);
              
            });

      });

    })    //imprimir los datos en la consola
    .catch(err => console.log('Solicitud fallida', err)); // Capturar errores

}


function pull_country_parts_destinations(country_slug,section){
  //console.log('Loading...');
  //console.log(('/' + country_slug + '/' + section));

  getCountryPartLocation(section);


  // Solicitud GET (Request).
  fetch('/data/' + country_slug + '/' + section)
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {
        result.forEach(function (item, index) {
          uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };

          pull_country_parts_destinations_commerces(country_slug , section , item.slug);

        });

      })    //imprimir los datos en la consola
      .catch(err => console.log('Solicitud fallida', err)); // Capturar errores
}


function pull_country_parts_destinations_commerces(country_slug,section,destination){

  fetch('/data/' + country_slug + '/' + section + '/' + destination)
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {

        //console.log(result);
        result.forEach(function (item, index) {

          uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };
          let host_point_marker;
          console.log(item);

          // The marker, positioned at Uluru
          host_point_marker = new google.maps.Marker({
            position: uluru,
            title: item.name,
            map: map,
            icon: icons['parking'].icon,
            //icon:svgMarkerHosting
          });

          let description =  "<hr><b>Descripcion:</b><div>" + item.description + "</div>" ;

          if (description == null ) description = "";

  
          let hotel_name = "<a href='/admin/hosting-provider/" + item.id + "/edit'>" + item.name + description ;

          // Add a click listener for each marker, and set up the info window.
          host_point_marker.addListener("click", () => {

                infoWindow.close();                
                infoWindow.setContent( hotel_name  );
                infoWindow.open(map, host_point_marker);
                
              });

        });

      })    //imprimir los datos en la consola
      .catch(err => console.log('Solicitud fallida', err)); // Capturar errores

}


function initMap() {
  

  pull_all_destinations_commerces();
}

window.onload = initMap;

</script>
  @yield('content')

  </div>
  
  
@endsection






  
