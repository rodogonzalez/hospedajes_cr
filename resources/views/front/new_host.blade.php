@extends(backpack_view('blank'))


@section('content')
<?php 

  $pos_lat = env('DEFAULT_LAT') ;
  $pos_lng = env('DEFAULT_LNG');   

?>

  <div class="container">
<style>
.frm_suscribir {
    display:flex;
    flex-direction: column;
}
.frm_suscribir label,
.frm_suscribir input,
.frm_suscribir select{
    width:100%;
}


</style>

    <h2>Bienvenido!</h2>
    <span>Sera un gusto recomendar su destino de hospedaje, ocuparemos algunos datos como los siguientes :</span>
    <form class="frm_suscribir">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
     

      <span><label>Pais</label><select name="country" id="current_country"  onchange="pull_country_parts(this.value)">
        <option value="">--select country--</option>
        @foreach ($paises as $pais)
          <option value="{{$pais->slug}}">{{$pais->name}}</option>
        @endforeach
      </select>
    </span>
    <span>
      <label>Departamento/Provincia</label><select name="country_part" id="country_part" onchange="pull_country_parts_destinations (document.getElementById('current_country').selectedOptions[0].value, this.value)"></select>
    </span>
    <span><label>Zona</label><select name="country_part_destinations" id="country_part_destinations"></select>
    </span>
    <span><label>Nombre</label><input name="" id="" value="" placeholder="">
    </span>
    <span><label>Correo del Establecimiento</label><input name="" id="" value="" placeholder="">
    </span>
    <span><label>Telefono</label><input name="" id="" value="" placeholder="">
    </span>
    <span><label>Descripcion</label><input name="" id="" value="" placeholder="">
    </span>
    <input type="text" name="position_lat" id="position_lat" value="" />
    <input type="text" name="position_lng" id="position_lng" value="" />
    <div id="map"></div><hr>
    <span><label>Imagenes</label>
      <input type="file">
      <input type="file">
      <input type="file">
      <input type="file">
      <input type="file">
      <input type="file">
    </span>
    
         
    <script>                           
        
    let uluru;

    function initMap() {

        uluru = { lat: parseFloat(  {{$pos_lat}} ), lng: parseFloat( {{$pos_lng}} ) };

        const map = new google.maps.Map(document.getElementById("map"), {
            center: { lat:  parseFloat( {{$pos_lat}} ), lng: parseFloat( {{$pos_lng}} ) },
            zoom: 10,
        });

        let marker;

        // The marker, positioned at Uluru
        marker = new google.maps.Marker({
                draggable: true,
            position: uluru,
            title: "posicion",
            //label: item.name,
            map: map,
            });

            marker.addListener("dragend", function(event) { 
                
                let lat = event.latLng.lat(); 
                let lng = event.latLng.lng(); 
                document.getElementById("position_lat").value = lat;
                document.getElementById("position_lng").value = lng;
                
            });

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
    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL2IDlZi53TxjIaLcQJRcWYnPRmmt4bt8" ></script>
                


    <input type="submit" value="Listar Hospedaje">
    </form>
  </div>


<script>

function pull_country_parts(country_slug){



let options_content = "";
document.getElementById("country_part").innerHTML = "<option>cargando...</option>";

// Solicitud GET (Request).
fetch('/' + country_slug)
    // Exito
    .then(response => response.json())  // convertir a json
    .then(result => {

      current_country_part = result;
  
      result.forEach(function (item, index) {
         

        options_content= options_content + "<option value='" +  item.slug + "'>" +  item.slug + "</option>";
 
      });

      document.getElementById("country_part").options.length = 0;        
      document.getElementById("country_part").innerHTML = options_content;
    })    
    //imprimir los datos en la consola
    .catch(err => console.log('Solicitud fallida', err)); // Capturar errores
    
}




function pull_country_parts_destinations(country_slug,section){  

  let options_content = "";
  document.getElementById("country_part_destinations").innerHTML = "<option>cargando...</option>";

  // Solicitud GET (Request).
  fetch('/' + country_slug + '/' + section)
      // Exito
      .then(response => response.json())  // convertir a json
      .then(result => {
        result.forEach(function (item, index) {                      
          options_content= options_content + "<option value='" +  item.slug + "'>" +  item.slug + "</option>";

        });

        
        document.getElementById("country_part_destinations").options.length = 0;        
        document.getElementById("country_part_destinations").innerHTML = options_content;

      })    //imprimir los datos en la consola
      .catch(err => console.log('Solicitud fallida', err)); // Capturar errores
}



</script>

@yield('content')


  
@endsection






  
