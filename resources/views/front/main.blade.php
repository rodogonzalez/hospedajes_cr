<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">
<head>
    @include(backpack_view('inc.head'))
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8" ></script>
</head>
<body class="app flex-row align-items-center">
<div>
  <h1>Info Turistica</h1>
  <ul>
    <li>Inicio</li>
    <li>¿Quienes Somos?</li>
    <li>Anunciate</li>
    <li><a href='/admin'>Mi Cuenta</a></li>
    <li>
        <select onchange="pull_country_parts(this.value)">
            @foreach ($paises as $pais)
              <option value='{{$pais["slug"]}}'>{{$pais["name"]}}</option>
            @endforeach
        </select>

    </li>
  </ul> 
</div>
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
<script>
    

 let map_points  ; 
 let uluru;
 
  
 let countries = {{ Illuminate\Support\Js::from($paises) }};


 uluru = { lat: parseFloat(countries[0].position_lat), lng: parseFloat(countries[0].position_lng) };


 const map = new google.maps.Map(document.getElementById("map"), {
   center: uluru,
   zoom: 8,
 });


 const infoWindow = new google.maps.InfoWindow();


 const iconBase =
    "https://developers.google.com/maps/documentation/javascript/examples/full/images/";
  const icons = {
    parking: {
      icon: iconBase + "parking_lot_maps.png",
    },
    library: {
      icon: iconBase + "library_maps.png",
    },
    info: {
      icon: iconBase + "info-i_maps.png",
    },
  };
 map_points= [];

function getCountryLocation(slug){



  countries.forEach(function (item, index) {

    uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };

    if (slug==item.slug ){      
      map.setCenter( uluru );
      
    }
  

  });



  
}


function pull_country_parts(country_slug){
  getCountryLocation(country_slug);
  
  


  // Solicitud GET (Request).
  fetch('/' + country_slug)
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {
    
        result.forEach(function (item, index) {

          uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };
          let point_marker;          

          // The marker, positioned at Uluru
          point_marker = new google.maps.Marker({
            position: uluru,
            title: item.slug,
            map: map,
            //icon: icons['library'].icon,

          });

//          pull_country_parts_destinations(country_slug,item.slug);

          // Add a click listener for each marker, and set up the info window.
          point_marker.addListener("click", () => {                              
              pull_country_parts_destinations(country_slug ,  item.slug);                
              });
              

        });

      })    //imprimir los datos en la consola
      .catch(err => console.log('Solicitud fallida', err)); // Capturar errores
}

function pull_country_parts_destinations(country_slug,section){
  console.log('Loading...');
  console.log(('/' + country_slug + '/' + section));
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

          // The marker, positioned at Uluru
          host_point_marker = new google.maps.Marker({
            position: uluru,
            title: item.name,
            map: map,
            icon: icons['parking'].icon,
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

  <footer class="app-footer sticky-footer">
    @include('backpack::inc.footer')
  </footer>

  @yield('before_scripts')
  @stack('before_scripts')

  @include(backpack_view('inc.scripts'))

  @yield('after_scripts')
  @stack('after_scripts')

</body>
</html>
