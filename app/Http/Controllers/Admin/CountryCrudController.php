<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CountryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CountryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CountryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Country::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/country');
        CRUD::setEntityNameStrings('Pais', 'Paises');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name')->label('Nombre');
        //CRUD::column('flag')->label('Bandera');
        CRUD::column('phone_prefix')->label('Prefijo');;
        //CRUD::column('description');
        CRUD::column('currency')->label('Moneda');;
        CRUD::column('language')->label('Nombre');;
        //CRUD::column('main_youtube_video');
        //CRUD::column('created_at');
        //CRUD::column('updated_at');

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
        CRUD::setValidation(CountryRequest::class);

        
        CRUD::field('name')->label('Nombre');
        //CRUD::field('flag')->label('Bandera');
        CRUD::field('phone_prefix')->label('Prefijo de Telefono');
        CRUD::field('description')->label('Descripcion');
        CRUD::field('currency')->label('Moneda');
        CRUD::field('language')->label('Lenguaje');
        CRUD::field('main_youtube_video')->label('Link Youtube');

        $this->crud->addField([   // Upload
                                    'name'      => 'flag',
                                    'label'     => 'Bandera',
                                    'type'      => 'upload',
                                    'upload'    => true,
                                    //'disk'      => 'public', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
                                    // optional:
                                    //'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URLs this will make a URL that is valid for the number of minutes specified
                                ]);

        

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
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
