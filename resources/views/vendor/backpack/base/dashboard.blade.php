@extends(backpack_view('blank'))



@section('content')
  <script>
    
    let map_points  ;
    
 

    
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

function pull_all_destinations_commerces(){

  fetch('/all-commerces')
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {

        const  map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: 9.9356876, lng: -84.2486378 },
          zoom: 10,
        });

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


    

    


    map_points= [];/* 
     */
  function initMap() {
   
    pull_all_destinations_commerces();
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

    
@endsection
