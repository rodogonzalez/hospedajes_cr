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
        <select id="current_country" onchange="pull_country_parts(this.value)">
            @foreach ($paises as $pais)
              <option value='{{$pais["slug"]}}'>{{$pais["name"]}}</option>
            @endforeach
        </select>
        <select id="country_part"  onchange="pull_country_parts_destinations (document.getElementById('current_country').selectedOptions[0].value, this.value)" sxxtyle="display:none"></select>


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
 let current_country_part ;
  
 let countries = {{ Illuminate\Support\Js::from($paises) }};


 uluru = { lat: parseFloat(countries[0].position_lat), lng: parseFloat(countries[0].position_lng) };


 const map = new google.maps.Map(document.getElementById("map"), {
   center: uluru,
   zoom: 4,
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




 const svgMarker = {
            path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
            fillColor: "blue",
            fillOpacity: 0.6,
            strokeWeight: 0,
            rotation: 0,
            scale: 2,
            //anchor: new google.maps.Point(15, 30),
          };

  const svgMarkerHosting = {
    path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
    fillColor: "black",
    fillOpacity: 0.9,
    strokeWeight: 0,
    rotation: 0,
    scale: 2,    
  };


 map_points= [];


function getCountryPartLocation(slug){

  current_country_part.forEach(function (item, index) {

    uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };

    if (slug==item.slug ){      
      map.setCenter( uluru );
      map.setZoom(15);


      
    }


    });


} 

function getCountryLocation(slug){



  countries.forEach(function (item, index) {

    uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };

    if (slug==item.slug ){      
      map.setCenter( uluru );
      map.setZoom(10);
      
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
            icon: svgMarker,

          });

//          pull_country_parts_destinations(country_slug,item.slug);

          // Add a click listener for each marker, and set up the info window.
          point_marker.addListener("click", () => {                              
              pull_country_parts_destinations(country_slug ,  item.slug);                
              });
              

        });

        document.getElementById("country_part").options.length = 0;
        console.log(options_content);
        document.getElementById("country_part").innerHTML = options_content;

      })    //imprimir los datos en la consola
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

          // The marker, positioned at Uluru
          host_point_marker = new google.maps.Marker({
            position: uluru,
            title: item.name,
            map: map,
            //icon: icons['parking'].icon,
            icon:svgMarkerHosting
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
