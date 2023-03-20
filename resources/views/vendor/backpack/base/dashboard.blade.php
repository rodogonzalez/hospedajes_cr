@extends(backpack_view('blank'))



@section('content')
  <script>
    
    let map_points  ;
    
    


    

    


    map_points= [];/* 
 
    */
  function initMap() {


    const map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: 9.9356876, lng: -84.2486378 },
      zoom: 10,
    });

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
