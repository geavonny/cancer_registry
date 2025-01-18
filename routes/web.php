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

//ENDPOINT UNTUK TABEL profile_pasien PADA DATABASE cancer_registry
$router->get('/profile', 'ProfileController@index'); //menampilkan keseluruhan data pada tabel profil pasien
$router->post('/profile/store', 'ProfileController@store'); //menginput data pasien baru
$router->get('/profile/{no_rekam_medis}', 'ProfileController@show'); //mencari data pasien berdasarkan no rekam medis, no registrasi, id
$router->put('/profile/update/{id}', 'ProfileController@update'); // update data pasien berdasarkan id pasien
$router->delete('/profile/delete/{no_rekam_medis}', 'ProfileController@destroy'); //delete data pasien secara keseluruhan berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL histori_pasien PADA DATABASE cancer_registry
$router->get('/histori', 'HistoriController@index'); //menampilkan keseluruhan data pada tabel histori pasien
$router->post('/histori/store', 'HistoriController@store'); //menginput data baru pada tabel histori pasien
$router->get('/histori/{no_rekam_medis}', 'HistoriController@show'); //mencari data pasien berdasarkan no rekam medis dan id
$router->put('/histori/update/{id}', 'HistoriController@update'); // update data pasien berdasarkan id pasien
$router->delete('/histori/delete/{no_rekam_medis}', 'HistoriController@destroy'); //delete histori data pasien berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL diagnosis PADA DATABASE cancer_registry
$router->get('/diagnosis', 'DiagnosisController@index'); //menampilkan keseluruhan data pada tabel diagnosis pasien
$router->post('/diagnosis/store', 'DiagnosisController@store');//menginput data baru pada tabel diagnosis pasien
$router->get('/diagnosis/{no_rekam_medis}', 'DiagnosisController@show');//mencari data pasien berdasarkan no rekam medis dan id
$router->put('/diagnosis/update/{id}', 'DiagnosisController@update');// update data pasien berdasarkan id pasien
$router->delete('/diagnosis/delete/{no_rekam_medis}', 'DiagnosisController@destroy');//delete diagnosis data pasien berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL rujukan PADA DATABASE cancer_registry
$router->get('/rujukan', 'RujukanController@index'); //menampilkan keseluruhan data pada tabel rujukan pasien
$router->post('/rujukan/store', 'RujukanController@store');//menginput data baru pada tabel rujukan pasien
$router->get('/rujukan/{no_rekam_medis}', 'RujukanController@show');//mencari data pasien berdasarkan no rekam medis dan id
$router->put('/rujukan/update/{id}', 'RujukanController@update');// update data pasien berdasarkan id pasien
$router->delete('/rujukan/delete/{no_rekam_medis}', 'RujukanController@destroy');//delete rujukan data pasien berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL rekam_medis PADA DATABASE cancer_registry
$router->get('/rekam', 'RekamController@index'); //menampilkan keseluruhan data pada tabel rekam medis pasien
$router->post('/rekam/store', 'RekamController@store');//menginput data baru pada tabel rekam medis pasien
$router->get('/rekam/{no_rekam_medis}', 'RekamController@show');//mencari data pasien berdasarkan no rekam medis dan id
$router->put('/rekam/update/{id}', 'RekamController@update');// update data pasien berdasarkan id pasien
$router->delete('/rekam/delete/{no_rekam_medis}', 'RekamController@destroy');//delete rekam medis data pasien berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL user PADA DATABASE cancer_registry
$router->get('/user', 'PenggunaController@index');//menampilkan keseluruhan data pada tabel user
$router->post('/user/store', 'PenggunaController@store');//menginput data baru pada tabel user
$router->get('/user/{id}', 'PenggunaController@show');//mencari data user berdasarkan id
$router->put('/user/update/{id}', 'PenggunaController@update');// update data user berdasarkan id user
$router->delete('/user/delete/{id}', 'PenggunaController@destroy');//delete data user berdasarkan id user

//ENDPOINT UNTUK TABEL content PADA DATABASE cancer_registry
$router->get('/konten', 'KontenController@index');//menampilkan keseluruhan data pada tabel content
$router->post('/konten/store', 'KontenController@store');//menginput data baru pada tabel content
$router->get('/konten/{judul}', 'KontenController@show');//mencari data content berdasarkan id content
$router->put('/konten/update/{id}', 'KontenController@update');// update data content berdasarkan id content
$router->delete('/konten/delete/{id}', 'KontenController@destroy');//delete data content berdasarkan id content

//ENDPOINT UNTUK TABEL faq PADA DATABASE cancer_registry
$router->get('/faq', 'FaqController@index');//menampilkan keseluruhan data pada tabel FAQ
$router->post('/faq/store', 'FaqController@store');//menginput data baru pada tabel FAQ
$router->get('/faq/{id}', 'FaqController@show');//mencari data FAQ berdasarkan id FAQ
$router->put('/faq/update/{id}', 'FaqController@update');// update data FAQ berdasarkan id FAQ
$router->delete('/faq/delete/{id}', 'FaqController@destroy');//delete data FAQ berdasarkan id FAQ

//ENDPOINT UNTUK TABEL gejala PADA DATABASE cancer_registry
$router->get('/gejala', 'GejalaController@index');//menampilkan keseluruhan data pada tabel gejala pasien
$router->post('/gejala/store', 'GejalaController@store');//menginput data baru pada tabel gejala pasien
$router->get('/gejala/{no_rekam_medis}', 'GejalaController@show');//mencari data gejala pasien berdasarkan no rekam medis dan id pasien
$router->put('/gejala/update/{id}', 'GejalaController@update');// update data gejala pasien berdasarkan id pasien
$router->delete('/gejala/delete/{no_rekam_medis}', 'GejalaController@destroy');//delete data gejala pasien berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL jadwal PADA DATABASE cancer_registry
$router->get('/jadwal', 'JadwalController@index');//menampilkan keseluruhan data pada tabel jadwal check-up
$router->post('/jadwal/store', 'JadwalController@store');//menginput data baru pada tabel jadwal check-up
$router->get('/jadwal/{no_rekam_medis}', 'JadwalController@show');//mencari data jadwal check-up pasien berdasarkan no rekam medis dan id pasien
$router->put('/jadwal/update/{id}', 'JadwalController@update');// update data jadwal check-up pasien berdasarkan id pasien
$router->delete('/jadwal/delete/{no_rekam_medis}', 'JadwalController@destroy');//delete data jadwal check-up pasien berdasarkan no rekam medis pasien

//ENDPOINT NOTIFIKASI CHECKUP
$router->get('/notifikasi', 'NotifikasiController@notifikasi'); //menampilkan reminder checkup pasien

//ENDPOINT LOGIN
$router->post('/login', 'loginController@ceklogin');
$router->post('/logout', 'loginController@logout');  