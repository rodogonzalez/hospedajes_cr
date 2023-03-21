@extends(backpack_view('blank'))



@section('content')
  <script>
    
    let map_points  ;
    
 
    let map;
    
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

function pull_all_destinations_commerces(){

  fetch('/all-commerces')
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {

        

        const infoWindow = new google.maps.InfoWindow();

        //console.log(result);
        result.forEach(function (item, index) {

          uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };
          let host_point_marker;
          //console.log(item);

          // The marker, positioned at Uluru
          host_point_marker = new google.maps.Marker({
            position: uluru,
            id:item.id,
            title: item.name,
            map: map,
            animation: google.maps.Animation.DROP,
            icon: iconBase,
            draggable: true //que el marcador se pueda arrastrar
            //icon:svgMarkerHosting
          });

          let description =  "<hr><b>Descripcion:</b><div>" + item.description + "</div>" ;

          if (description == null ) description = "";

  
          let hotel_name = "<a href='/admin/hosting-provider/" + item.id + "/edit'>" + item.name + description + "</a>";

          // Add a click listener for each marker, and set up the info window.
          host_point_marker.addListener("click", () => {

                infoWindow.close();                
                infoWindow.setContent( hotel_name  );
                infoWindow.open(map, host_point_marker);
                
              });
          host_point_marker.addListener("dragend", (data) => {
            

            fetch('/relocate/', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': '{{csrf_token()}}'

                },
                body: JSON.stringify({ "id": item.id , "lat":data.latLng.lat(),"lng": data.latLng.lng() })
            })
              .then(response => response.json())
              .then(response => console.log(JSON.stringify(response)))


            });

        });

      })    //imprimir los datos en la consola
      .catch(err => console.log('Solicitud fallida', err)); // Capturar errores

}


 
function pull_all_destinations(){

  fetch('/all-destinations')
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {

        const infoWindow = new google.maps.InfoWindow();

        result.forEach(function (item, index) {
          uluru = { lat: parseFloat(item.position_lat), lng: parseFloat(item.position_lng) };        
          let host_point_marker;

          host_point_marker = new google.maps.Marker({
              position: uluru,
              title: item.name,
              map: map,
            

              //icon: iconBase,
              //icon:svgMarkerHosting
            });

          // Add a click listener for each marker, and set up the info window.
          host_point_marker.addListener("click", () => {
              infoWindow.close();                
              infoWindow.setContent( item.name  );
              infoWindow.open(map, host_point_marker);
            });
 

        });
      })   
      .catch(err => console.log('Solicitud fallida', err)); // Capturar errores

}


    


    map_points= [];/* 

     */
  function initMap() {

    map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: 9.9356876, lng: -84.2486378 },
          zoom: 10,
        });
    

    pull_all_destinations_commerces();
    //pull_all_destinations();
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
