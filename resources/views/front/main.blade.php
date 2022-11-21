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
    
const map = new google.maps.Map(document.getElementById("map"), {
   center: { lat: 9.9356876, lng: -84.2486378 },
   zoom: 10,
 });


 const infoWindow = new google.maps.InfoWindow();
 let map_points  ; 
 let uluru;
 
  
 let countries = {{ Illuminate\Support\Js::from($paises) }};

 map_points= [];


function pull_country_parts(country_slug){
  //country_marker
  //alert();
  

  // Solicitud GET (Request).
  fetch('/' + country_slug)
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {

        //console.log(result);
        result.forEach(function (item, index) {



          uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };
          let point_marker;
          

          // The marker, positioned at Uluru
          point_marker = new google.maps.Marker({
            position: uluru,
            title: item.slug,
            map: map,
          });

          // Add a click listener for each marker, and set up the info window.
          point_marker.addListener("click", () => {                
              
              pull_country_parts_destinations(country_slug ,  item.slug);                
              });






        });


        


      })    //imprimir los datos en la consola
      .catch(err => console.log('Solicitud fallida', err)); // Capturar errores



}



function pull_country_parts_destinations(country_slug,section){
  //country_marker
  //alert();

  // Solicitud GET (Request).
  fetch('/' + country_slug + '/' + section)
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {

        //console.log(result);
        result.forEach(function (item, index) {



          uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };
          let point_marker;

          // The marker, positioned at Uluru
          point_marker = new google.maps.Marker({
            position: uluru,
            title: item.slug,
            map: map,
          });

          // Add a click listener for each marker, and set up the info window.
          point_marker.addListener("click", () => {
                infoWindow.close();
                pull_country_parts_destinations_commerces(country_slug , section ,  point_marker.getTitle());
                //pull_country_parts(country_marker.getTitle());
                //infoWindow.setContent("<a href=\'" +   + "\'>" + marker.getTitle()  + "</a>");
                //infoWindow.open(marker.getMap(), marker);
              });






        });


        


      })    //imprimir los datos en la consola
      .catch(err => console.log('Solicitud fallida', err)); // Capturar errores



}




function pull_country_parts_destinations_commerces(country_slug,section,destination){
  //country_marker
  //alert();

  // Solicitud GET (Request).
  fetch('/' + country_slug + '/' + section + '/' + destination)
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {

        //console.log(result);
        result.forEach(function (item, index) {



          uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };
          let point_marker;

          // The marker, positioned at Uluru
          point_marker = new google.maps.Marker({
            position: uluru,
            title: item.slug,
            map: map,
          });

          // Add a click listener for each marker, and set up the info window.
          point_marker.addListener("click", () => {
                infoWindow.close();
                alert(point_marker.getTitle());
                
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
     });

     // Add a click listener for each marker, and set up the info window.
     country_marker.addListener("click", () => {
           infoWindow.close();
           pull_country_parts(country_marker.getTitle());
           //infoWindow.setContent("<a href=\'" +   + "\'>" + marker.getTitle()  + "</a>");
           //infoWindow.open(marker.getMap(), marker);
         });

   //console.log(item,uluru, index);
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
