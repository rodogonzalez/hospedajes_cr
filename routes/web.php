<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return redirect('/admin');

});
*/
//Route::get('/',  [IndexController::class, 'show_index']);
Route::get('/',  [IndexController::class, 'show_index_front_end']);

Route::get('/new-host',  [IndexController::class, 'show_new_host_front_end'])->name("new-host");
Route::post('/relocate',  [IndexController::class, 'relocateitem'])->name("relocate-item");

Route::get('/all-commerces',  [IndexController::class, 'all_commerces'])->name("all-host");
Route::get('/all-destinations',  [IndexController::class, 'all_destinations'])->name("all-destinations");
Route::get('/{country_slug}',  [IndexController::class, 'show_country']);
Route::get('/{country_slug}/{country_part}',  [IndexController::class, 'show_country_part']);
//Route::get('/{country_slug}/{country_part}/{part_destination}',  [IndexController::class, 'show_country_part']);
Route::get('/{country_slug}/{country_part}/{part_destination}', [IndexController::class, 'show_country_part_destination']);



