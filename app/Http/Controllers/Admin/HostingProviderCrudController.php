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
class HostingProviderCrudController extends AbstractLocationFields
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
        CRUD::setModel(\App\Models\HostingProvider::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/hosting-provider');
        CRUD::setEntityNameStrings('Hospedaje', 'Hospedajes');

        //author_users_id
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {        
        if (!backpack_user()->hasRole('Admin')){
            $this->crud->addClause('where', 'author_users_id', backpack_user()->id); 
        }       

        CRUD::column('country_parts_destinations_id');
        CRUD::column('name');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        CRUD::setValidation(HostingProviderRequest::class);               
        //if ($this->crud->getCurrentEntry() === false ) {}      

        $this->crud->addField([  // Select            
            'name'      => 'author_users_id', 
            'type'  => 'hidden',
            'value' => backpack_user()->id,            
        ]);

        $this->crud->addField([  // Select
            'label'     => "js_script",
            'name'      => 'js_code', 
            'type'  => 'custom_html',
            'value' => $this->build_js_code(),            
        ]);
        
        
  
        $this->crud->addField([  // Select
            'label'     => "Pais",
            'type'      => 'select',
            'name'      => 'countries_id', 
            //'fake' => true, 

//            'entity'    => 'country',         
            // optional - manually specify the related model and attribute
            'model'     => "App\Models\Country", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user        

            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'ASC')->get();
             }), //  you can use this to filter the results show in the select

             'attributes' => [
                'id' => 'country_id',
                'onchange' => 'pull_country_parts(this.value)',                
                'required' => 'required',                
                ], // 


            ]);
        
        $this->crud->addField([  // Select
            'label'     => "Provincia",
            'type'      => 'select',
            'name'      => 'country_parts_id', 
            //'fake' => true, 
            //'entity'    => 'country_parts_destinations',         
            // optional - manually specify the related model and attribute
            'model'     => "App\Models\CountryPart", // related model
            'attribute' => 'slug', // foreign key attribute that is shown to user         
            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                   return $query->orderBy('id', 'ASC')->orderBy('name', 'ASC')->get();
                }), //  you can use this to filter the results show in the select


            'attributes' => [
                'id' => 'country_part',
                'onchange' => 'pull_country_parts_destinations(this.value)',                                
                'required' => 'required',                
                
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

                if  ($this->crud->getCurrentEntry() !== false ){
                    return $query->orderBy('country_parts_id', 'ASC')->orderBy('name', 'ASC')->where('id', $this->crud->getCurrentEntry()->country_parts_destinations_id )->get();
                }else{
                    return $query->orderBy('country_parts_id', 'ASC')->orderBy('name', 'ASC')->get();
                }
                 
             }), //  you can use this to filter the results show in the select
             'attributes' => [
                'id' => 'country_part_destinations',
                'onchange' => 'a',                
                ], // 
            ]);
        

    //CRUD::field('name');
        $this->crud->addField(['name' => 'name','type' => 'text','label' => "Nombre", 'attributes' => ['required' => 'required' ]]);        
        $this->crud->addField(['name' => 'slug','type' => 'text','label' => "URL Segment (slug)", 'attributes' => ['required' => 'required' ]]);
        $this->crud->addField(['name' => 'email','type' => 'text','label' => "Email", 'attributes' => ['required' => 'required' ]]);
        $this->crud->addField(['name' => 'phone_contact','type' => 'text','label' => "Telefono", 'attributes' => ['required' => 'required' ]]);
        $this->crud->addField([   // Upload
            'name'      => 'description',
            'label'     => 'Descripcion',
            'type'      => 'textarea',
         ]);



        
        $this->crud->addField([   // Checklist
            'label'     => 'Caracteristicas Generales',
            'type'      => 'checklist',
            'name'      => 'features',            
            'model'     => "App\Models\HostingFeature",
            'pivot'     => false,
        ]);

        $this->setLocationFields();        

        
        $this->crud->addField([   // Upload
            'name'      => 'photos',
            'label'     => 'Fotografias',
            'type'      => 'upload_multiple',
            'upload'    => true,
        ]);



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
