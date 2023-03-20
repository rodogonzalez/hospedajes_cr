<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TourRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TourCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TourCrudController extends AbstractLocationFields
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Tour::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tour');
        CRUD::setEntityNameStrings('tour', 'tours');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('country_parts_destinations_id');
        CRUD::column('name');
        CRUD::column('price');
        CRUD::column('description');
        CRUD::column('created_at');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TourRequest::class);

        

        
        $this->crud->addField([  // Select
            'label'     => "js_script",
            'name'      => 'js_code', 
            'type'  => 'custom_html',
            'value' => $this->build_js_code(),            
        ]);
        
        
  
        $this->crud->addField([  // Select
            'label'     => "Pais",
            'type'      => 'select',
            'name'      => 'country_id', 
            'fake' => true, 

//            'entity'    => 'country',         
            // optional - manually specify the related model and attribute
            'model'     => "App\Models\Country", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user        

            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                 return $query->orderBy('name', 'ASC')->get();
             }), //  you can use this to filter the results show in the select

             'attributes' => [
                'id' => 'country_id',
                'onchange' => 'pull_country_parts(this.value)',                
                ], // 


            ]);
        
        $this->crud->addField([  // Select
            'label'     => "Provincia",
            'type'      => 'select',
            'name'      => 'country_part_id', 
            'fake' => true, 
            //'entity'    => 'country_parts_destinations',         
            // optional - manually specify the related model and attribute
            'model'     => "App\Models\CountryPart", // related model
            'attribute' => 'slug', // foreign key attribute that is shown to user         
            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                   return $query->orderBy('id', 'ASC')->orderBy('name', 'ASC')->take(0)->get();
                }), //  you can use this to filter the results show in the select


            'attributes' => [
                'id' => 'country_part',
                'onchange' => 'pull_country_parts_destinations(this.value)',                
                ], // 


            ]);        
    
  
        $this->crud->addField([  // Select
            'label'     => "Ubicacion",
            'type'      => 'select',
            'name'      => 'country_parts_destinations_id', 
            'entity'    => 'country_parts_destinations',         
            // optional - manually specify the related model and attribute
            'model'     => "App\Models\CountryPartsDestination", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user         
            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                //dd($this->crud->getCurrentEntry());

                if  ($this->crud->getCurrentEntry() !== false ){
                    return $query->orderBy('country_parts_id', 'ASC')->orderBy('name', 'ASC')->where('id', $this->crud->getCurrentEntry()->country_parts_destinations_id )->get();
                }else{
                    return $query->orderBy('country_parts_id', 'ASC')->orderBy('name', 'ASC')->take(0)->get();
                }
                

                 
             }), //  you can use this to filter the results show in the select



             'attributes' => [
                'id' => 'country_part_destinations',
                'onchange' => 'a',                
                ], // 


            ]);
        



        CRUD::field('name');

        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => "URL Segment (slug)"
          ]);
        CRUD::field('price');
        CRUD::field('description');


        
        $this->crud->addField([   // Upload
            'name'      => 'photos',
            'label'     => 'Fotografias',
            'type'      => 'upload_multiple',
            'upload'    => true,
            //'disk'      => 'public', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
            // optional:
            //'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URLs this will make a URL that is valid for the number of minutes specified
        ]);
        $this->setLocationFields();        
        
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
