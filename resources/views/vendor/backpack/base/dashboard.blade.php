@extends(backpack_view('blank'))



@section('content')
  <script>
    let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });
}

window.initMap = initMap;
  </script>

<style>

    #map{
        display:block;
        width:100%;
        height:100%;

    }
</style>
  
  
    <div id="map"></div>
  
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8&amp;libraries=places&amp;ver=6.0.2" id="wcfm-store-google-maps-js"></script>
@endsection
