@extends(backpack_view('blank'))


@section('content')

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
    "https://developers.google.com/maps/documentation/javascript/examples/full/images/";
  const icons = {
    parking: {
      icon: iconBase + "beachflag.png",
    },
    library: {
      icon: iconBase + "library_maps.png",
    },
    info: {
      icon: iconBase + "info-i_maps.png",
    },

  };

 const svgMarker = {
            path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
            fillColor: "black",
            fillOpacity: 0.6,
            strokeWeight: 0,
            rotation: 0,
            scale: 1,            
          };

  const svgMarkerHosting = {
    path: "M17.592,8.936l-6.531-6.534c-0.593-0.631-0.751-0.245-0.751,0.056l0.002,2.999L5.427,9.075H2.491c-0.839,0-0.162,0.901-0.311,0.752l3.683,3.678l-3.081,3.108c-0.17,0.171-0.17,0.449,0,0.62c0.169,0.17,0.448,0.17,0.618,0l3.098-3.093l3.675,3.685c-0.099-0.099,0.773,0.474,0.773-0.296v-2.965l3.601-4.872l2.734-0.005C17.73,9.688,18.326,9.669,17.592,8.936 M3.534,9.904h1.906l4.659,4.66v1.906L3.534,9.904z M10.522,13.717L6.287,9.48l4.325-3.124l3.088,3.124L10.522,13.717z M14.335,8.845l-3.177-3.177V3.762l5.083,5.083H14.335z",
    fillColor: "black",
    fillOpacity: 0.9,
    strokeWeight: 0,
    rotation: 0,
    scale: 1,    
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
  fetch('/' + country_slug)
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

function pull_country_parts_destinations(country_slug,section){
  //console.log('Loading...');
  //console.log(('/' + country_slug + '/' + section));

  getCountryPartLocation(section);


  // Solicitud GET (Request).
  fetch('/' + country_slug + '/' + section)
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {
        result.forEach(function (item, index) {
          uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };
  /*
          let point_marker;
          // The marker, positioned at Uluru
          point_marker = new google.maps.Marker({
            position: uluru,
            title: item.slug,
            map: map,
          });
*/
          pull_country_parts_destinations_commerces(country_slug , section , item.slug);
/*
          // Add a click listener for each marker, and set up the info window.
          point_marker.addListener("click", () => {
                infoWindow.close();
                pull_country_parts_destinations_commerces(country_slug , section ,  point_marker.getTitle());
                
              });
*/
        });

      })    //imprimir los datos en la consola
      .catch(err => console.log('Solicitud fallida', err)); // Capturar errores
}


function pull_country_parts_destinations_commerces(country_slug,section,destination){
  //console.log('Loading...');
  //console.log('/' + country_slug + '/' + section + '/' + destination)
  // Solicitud GET (Request).
  fetch('/' + country_slug + '/' + section + '/' + destination)
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
 
 countries.forEach(function (item, index) {

    uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };

    let country_marker;

     // The marker, positioned at Uluru
     country_marker = new google.maps.Marker({
       position: uluru,
       title: item.slug,
       map: map,
       //icon: svgMarker
     //  icon: icons['info'].icon,
     });

     if (index==0) pull_country_parts(item.slug);


     // Add a click listener for each marker, and set up the info window.
     country_marker.addListener("click", () => {
           infoWindow.close();
           pull_country_parts(country_marker.getTitle());
           //infoWindow.setContent("<a href=\'" +   + "\'>" + marker.getTitle()  + "</a>");
           //infoWindow.open(marker.getMap(), marker);
         });

 });
}

window.onload = initMap;

</script>
  @yield('content')
  </div>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8" ></script>
  
@endsection






  
