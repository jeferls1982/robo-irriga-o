<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('/paises', 'Blade\CountryController');




Route::resource('/horta', 'Irrigacao\HortaController');
Route::resource('/robo', 'Irrigacao\RoboController');
Route::resource('/irrigacao', 'Irrigacao\IrrigacaoController');
Route::get('/irrigacao/iniciar/{id}', 'Irrigacao\IrrigacaoController@iniciarIrrigacao');


Route::get('/', function () {
    return view('irrigacao.pages.home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
