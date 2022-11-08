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
Route::get('/',  [IndexController::class, 'show_index']);

Route::get('/{country_slug}',  [IndexController::class, 'show_country']);

Route::get('/{country_slug}/{country_part}',  [IndexController::class, 'show_country_part']);

Route::get('/{country_slug}/{country_part}/{part_destination}',  [IndexController::class, 'show_country_part']);
 


Route::get('/{country_slug}/{country_part}/{part_destination}', [IndexController::class, 'show_country_part_destination']);
