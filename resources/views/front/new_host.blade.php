@extends(backpack_view('blank'))


@section('content')

  <div class="container">


    <h2>Bienvenido!</h2>
    <span>Sera un gusto recomendar su destino de hospedaje, ocuparemos algunos datos como los siguientes :</span>
    <form>
      <label>Pais</label><select name="country" id="current_country"  onchange="pull_country_parts(this.value)">
        <option value="">--select country--</option>
        @foreach ($paises as $pais)
          <option value="{{$pais->slug}}">{{$pais->name}}</option>
        @endforeach
      </select>
      <label>Departamento/Provincia</label><select name="country_part" id="country_part" onchange="pull_country_parts_destinations (document.getElementById('current_country').selectedOptions[0].value, this.value)"></select>
      <label>Zona</label><select name="country_part_destinations" id="country_part_destinations"></select>
      <label>Nombre</label><input name="" id="" value="" placeholder="">
      <label>Correo del Establecimiento</label><input name="" id="" value="" placeholder="">
      <label>Telefono</label><input name="" id="" value="" placeholder="">
      <label>Descripcion</label><input name="" id="" value="" placeholder="">
      <label>Imagenes</label>
      <input type="file">
      <input type="file">
      <input type="file">
      <input type="file">
      <input type="file">
      <input type="file">
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






  
