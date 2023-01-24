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
        //CRUD::column('position_lng');
        //CRUD::column('position_lat');
        CRUD::column('name');
        //CRUD::column('description');
        //CRUD::column('created_at');
        //CRUD::column('updated_at');
/*
        // dropdown filter
        $this->crud->addFilter([
            'name'  => 'name',
            'type'  => 'dropdown',
            'label' => 'Status'
        ], [
            1 => 'In stock',
            2 => 'In provider stock',
            3 => 'Available upon ordering',
            4 => 'Not available',
        ], function($value) { // if the filter is active
            // $this->crud->addClause('where', 'status', $value);
        });

*/
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

        CRUD::setValidation(HostingProviderRequest::class);        
        CRUD::field('name');
        $this->crud->addField(['name' => 'slug','type' => 'text','label' => "URL Segment (slug)"]);
        $this->crud->addField(['name' => 'email','type' => 'text','label' => "Email"]);
        $this->crud->addField(['name' => 'phone_contact','type' => 'text','label' => "Telefono"]);

        $this->crud->addField([   // Upload
            'name'      => 'description',
            'label'     => 'Descripcion',
            'type'      => 'textarea',
         ]);

        
  
        $this->crud->addField([  // Select
            'label'     => "Ubicacion OR",
            'type'      => 'select',
            'name'      => 'country_parts_destinations_id', 
            'entity'    => 'country_parts_destinations',         
            // optional - manually specify the related model and attribute
            'model'     => "App\Models\CountryPartsDestination", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user         
            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                 return $query->orderBy('country_parts_id', 'ASC')->orderBy('name', 'ASC')->get();
             }), //  you can use this to filter the results show in the select
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
