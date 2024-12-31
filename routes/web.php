<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/profile', 'ProfileController@index');
$router->post('/profile/store', 'ProfileController@store');
$router->get('/profile/rekmed/{no_rekam_medis}', 'ProfileController@show');
$router->put('/profile/update/{id}', 'ProfileController@update');
$router->delete('/profile/delete/{id}', 'ProfileController@destroy');

$router->get('/histori', 'HistoriController@index');
$router->post('/histori/store', 'HistoriController@store');
$router->get('/histori/rekmed/{no_rekam_medis}', 'HistoriController@show');
$router->put('/histori/update/{id}', 'HistoriController@update');
$router->delete('/histori/delete/{id}', 'HistoriController@destroy');

$router->get('/diagnosis', 'DiagnosisController@index');
$router->post('/diagnosis/store', 'DiagnosisController@store');
$router->get('/diagnosis/rekmed/{no_rekam_medis}', 'DiagnosisController@show');
$router->put('/diagnosis/update/{id}', 'DiagnosisController@update');
$router->delete('/diagnosis/delete/{id}', 'DiagnosisController@destroy');

$router->get('/rujukan', 'RujukanController@index');
$router->post('/rujukan/store', 'RujukanController@store');
$router->get('/rujukan/rekmed/{no_rekam_medis}', 'RujukanController@show');
$router->put('/rujukan/update/{id}', 'RujukanController@update');
$router->delete('/rujukan/delete/{id}', 'RujukanController@destroy');

$router->get('/rekam', 'RekamController@index');
$router->post('/rekam/store', 'RekamController@store');
$router->get('/rekam/rekmed/{no_rekam_medis}', 'RekamController@show');
$router->put('/rekam/update/{id}', 'RekamController@update');
$router->delete('/rekam/delete/{id}', 'RekamController@destroy');
