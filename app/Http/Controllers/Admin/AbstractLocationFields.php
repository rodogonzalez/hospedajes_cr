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
class  AbstractLocationFields extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setLocationFields(){

        

        //CRUD::field('position_lng');
        $this->crud->addField([   // CustomHTML
            'name'  => 'position_lng',
            'type'  => 'hidden',
            //'attributes'  => ' id = "position_lng" '
            'attributes' => [ 'id' => 'position_lng']


            ]);
        $this->crud->addField([   // CustomHTML
            'name'  => 'position_lat',
            'type'  => 'hidden',
            
            //'attributes'  => ' id = "" '
            'attributes' => [ 'id' => 'position_lat']


            ]);
            


        $pos_lat = 0;
        $pos_lng = 0;            
        
        if ($this->crud->getCurrentEntry() !== false) {
            $pos_lat = floatval ($this->crud->getCurrentEntry()->position_lat);
            $pos_lng = floatval ($this->crud->getCurrentEntry()->position_lng);            
        }
        
 

        $this->crud->addField([   // CustomHTML
            'name'  => 'separator',
            'type'  => 'custom_html',
            'label'      => 'Ubicacion',
            'value' => '<div id="map"></div><hr>
                        
                        <script>
                            

                
                let uluru;


            function initMap() {





                uluru = { lat: parseFloat(' . $pos_lat .'), lng: parseFloat(' . $pos_lng .') };


                const map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat:  parseFloat(' . $pos_lat .'), lng: parseFloat(' . $pos_lng .') },
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


                        //console.log(event.latLng);

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
                        '
                    ]);

    }

        

    

}
