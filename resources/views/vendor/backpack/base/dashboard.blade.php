@extends(backpack_view('blank'))



@section('content')
  <script>
    
    let map_points  ;
    
    let uluru;

    map_points= <?php 
    
    $hospedajes = \App\Models\HostingProvider::all();
    echo $hospedajes->toJson();
    ?>;
  function initMap() {


    const map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: 9.9356876, lng: -84.2486378 },
      zoom: 10,
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
        height:300px;
        border:1px solid #000;
    }
</style>
  
  
    <div id="map"></div>
  
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8" ></script>

    
@endsection
