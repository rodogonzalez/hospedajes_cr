<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\HostingProviderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class HostingProviderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AbstractLocationFields extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

    /**this function builds the js code necesary for drop down and other custumization */
    public function build_js_code()
    {
        return '
<script>    

function pull_country_parts_destinations(section){  

    let country_slug = document.getElementById("country_id").value;
    let options_content = "";
    document.getElementById("country_part_destinations").innerHTML = "<option>cargando...</option>";
  
    // Solicitud GET (Request).
    fetch("/data/" + country_slug + "/" + section)
        // Exito
        .then(response => response.json())  // convertir a json
        .then(result => {
          result.forEach(function (item, index) {                      
            options_content= options_content + "<option value=\'" +  item.id + "\'>" +  item.slug + "</option>";            
            
  
          });
  
          
          document.getElementById("country_part_destinations").options.length = 0;        
          document.getElementById("country_part_destinations").innerHTML = options_content;
  
        })    //imprimir los datos en la consola
        .catch(err => console.log("Solicitud fallida", err)); // Capturar errores
  }
  



function pull_country_parts(country_slug){

        
    let options_content = "";
  
    document.getElementById("country_part").innerHTML = "<option>cargando...</option>";
  
    // Solicitud GET (Request).
    fetch("/data/" + country_slug)
        // Exito
        .then(response => response.json())  // convertir a json
        .then(result => {
  
          current_country_part = result;
      
          result.forEach(function (item, index) {              
  
            options_content= options_content + "<option value=\'" +  item.id + "\'>" +  item.slug + "</option>";
            if (index==0) pull_country_parts_destinations ( item.id ) 
  
  
          });
  
          document.getElementById("country_part").options.length = 0;        
          document.getElementById("country_part").innerHTML = options_content;
        })    
        //imprimir los datos en la consola
        .catch(err => console.log("Solicitud fallida", err)); // Capturar errores
        
  }
  </script>  
        ';
    }

    public function setLocationFields()
    {
        $pos_lat = env('DEFAULT_LAT');
        $pos_lng = env('DEFAULT_LNG');

        if ($this->crud->getCurrentEntry() !== false) {
            $pos_lat = floatval($this->crud->getCurrentEntry()->position_lat);
            $pos_lng = floatval($this->crud->getCurrentEntry()->position_lng);
        }

        //CRUD::field('position_lng');
        $this->crud->addField([  // CustomHTML
                                  'name'  => 'position_lng',
                                  'type'  => 'text',
                                  'value' => $pos_lng,
                                  //'attributes'  => ' id = "position_lng" '
                                  'attributes' => [
                                      'id'       => 'position_lng',
                                      'readonly' => 'readonly',
                                      'default'  => env('DEFAULT_LNG')
                                  ]
                              ]);
        $this->crud->addField([  // CustomHTML
                                  'name'  => 'position_lat',
                                  'type'  => 'text',
                                  'value' => $pos_lat,

                                  //'attributes'  => ' id = "" '
                                  'attributes' => [
                                      'id'       => 'position_lat',
                                      'readonly' => 'readonly',
                                      'default'  => env('DEFAULT_LAT')
                                  ]
                              ]);

        $script_locate_me = '
            console.log("Not Detection found ");
            // default location 
            uluru = { lat: parseFloat(' . $pos_lat . '), lng: parseFloat(' . $pos_lng . ') };            
            showMap();

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                  (position) => {
                    const pos = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude,
                    };
                    uluru.lat = pos.lat;
                    uluru.lng = pos.lng;                              
                  }                  
                );
              } 


        ';

        $this->crud->addField([  // CustomHTML
                                  'name'  => 'separator',
                                  'type'  => 'custom_html',
                                  'label' => 'Ubicacion',
                                  'value' => '<span onclick="detect_location();return false;">Detectar</span>
            <div id="map"></div>
            <hr>         
            <script>                                          
            let uluru = { lat: parseFloat(' . $pos_lat . '), lng: parseFloat(' . $pos_lng . ') };
            // The marker, positioned at Uluru
            let map, marker  ;

            function detect_location(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                      (position) => {                        
                            uluru.lat= parseFloat(position.coords.latitude);
                            uluru.lng= parseFloat(position.coords.longitude);
                            document.getElementById("position_lat").value = uluru.lat;
                            document.getElementById("position_lng").value = uluru.lng;                                                                                                              
                            marker.setMap(null);
                            marker=null;

                            // The marker, positioned at Uluru
                            marker  = new google.maps.Marker({
                                    draggable: true,
                                    position: uluru,                   
                                    map: map,
                                });

                            marker.addListener("dragend", function(event) { 
                                
                                let lat = event.latLng.lat(); 
                                let lng = event.latLng.lng(); 
                                document.getElementById("position_lat").value = lat;
                                document.getElementById("position_lng").value = lng;
                                
                            });
                        });
                }
            }

            function showMap(){                

                map = new google.maps.Map(document.getElementById("map"), {
                    center: uluru,
                    zoom: 10,
                });

                // The marker, positioned at Uluru
                marker  = new google.maps.Marker({
                        draggable: true,
                        position: uluru,                   
                        map: map,
                    });

                marker.addListener("dragend", function(event) { 
                    
                    let lat = event.latLng.lat(); 
                    let lng = event.latLng.lng(); 
                    document.getElementById("position_lat").value = lat;
                    document.getElementById("position_lng").value = lng;
                    
                });

            }
            
            function initMap() {
                ' . $script_locate_me . '               
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
                        '
                              ]);
    }
}
