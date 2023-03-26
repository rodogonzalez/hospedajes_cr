<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('country', 'CountryCrudController');
    Route::crud('hosting-feature', 'HostingFeatureCrudController');
    Route::crud('tour-activity-type', 'TourActivityTypeCrudController');
    Route::crud('country-part', 'CountryPartCrudController');
    Route::crud('country-parts-destination', 'CountryPartsDestinationCrudController');
    Route::crud('hosting-provider', 'HostingProviderCrudController');
    Route::crud('hosting-offer', 'HostingOfferCrudController');
    Route::crud('tour', 'TourCrudController');
    Route::crud('airline', 'AirlineCrudController');
    Route::crud('rent-a-car', 'RentACarCrudController');    
}); // this should be the absolute last line of this file



Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
 
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    
    Route::crud('hosting-provider', 'HostingProviderCrudController');
    Route::crud('hosting-offer', 'HostingOfferCrudController');
    Route::crud('tour', 'TourCrudController');    
}); // this should be the absolute last line of this file