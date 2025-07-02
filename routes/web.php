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
$router->get('/Patient', 'ProfileController@index'); //menampilkan keseluruhan data pada tabel profil pasien
$router->post('/Patient/store', 'ProfileController@store'); //menginput data pasien baru
$router->get('/Patient/{no_rekam_medis}', 'ProfileController@show'); //mencari data pasien berdasarkan no rekam medis, no registrasi, id
$router->put('/Patient/update/{id}', 'ProfileController@update'); // update data pasien berdasarkan id pasien
$router->get('/Patient/delete/{no_rekam_medis}', 'ProfileController@destroy'); //delete data pasien secara keseluruhan berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL histori_pasien PADA DATABASE cancer_registry
$router->get('/DiagnosticReport', 'HistoriController@index'); //menampilkan keseluruhan data pada tabel histori pasien
$router->post('/DiagnosticReport/store', 'HistoriController@store'); //menginput data baru pada tabel histori pasien
$router->get('/DiagnosticReport/{no_rekam_medis}', 'HistoriController@show'); //mencari data pasien berdasarkan no rekam medis dan id
$router->put('/DiagnosticReport/update/{id}', 'HistoriController@update'); // update data pasien berdasarkan id pasien
$router->get('/DiagnosticReport/delete/{no_rekam_medis}', 'HistoriController@destroy'); //delete histori data pasien berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL diagnosis PADA DATABASE cancer_registry
$router->get('/Condition', 'DiagnosisController@index'); //menampilkan keseluruhan data pada tabel diagnosis pasien
$router->post('/Condition/store', 'DiagnosisController@store');//menginput data baru pada tabel diagnosis pasien
$router->get('/Condition/{no_rekam_medis}', 'DiagnosisController@show');//mencari data pasien berdasarkan no rekam medis dan id
$router->put('/Condition/update/{id}', 'DiagnosisController@update');// update data pasien berdasarkan id pasien
$router->get('/Condition/delete/{no_rekam_medis}', 'DiagnosisController@destroy');//delete diagnosis data pasien berdasarkan no rekam medis pasien


//ENDPOINT UNTUK TABEL rujukan PADA DATABASE cancer_registry
$router->get('/Referral', 'RujukanController@index'); //menampilkan keseluruhan data pada tabel rujukan pasien
$router->post('/Referral/store', 'RujukanController@store');//menginput data baru pada tabel rujukan pasien
$router->get('/Referral/{no_rekam_medis}', 'RujukanController@show');//mencari data pasien berdasarkan no rekam medis dan id
$router->put('/Referral/update/{id}', 'RujukanController@update');// update data pasien berdasarkan id pasien
$router->get('/Referral/delete/{no_rekam_medis}', 'RujukanController@destroy');//delete rujukan data pasien berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL rekam_medis PADA DATABASE cancer_registry
$router->get('/Observation', 'RekamController@index'); //menampilkan keseluruhan data pada tabel rekam medis pasien
$router->post('/Observation/store', 'RekamController@store');//menginput data baru pada tabel rekam medis pasien
$router->get('/Observation/{no_rekam_medis}', 'RekamController@show');//mencari data pasien berdasarkan no rekam medis dan id
$router->put('/Observation/update/{id}', 'RekamController@update');// update data pasien berdasarkan id pasien
$router->get('/Observation/delete/{no_rekam_medis}', 'RekamController@destroy');//delete rekam medis data pasien berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL user PADA DATABASE cancer_registry
$router->get('/User', 'PenggunaController@index');//menampilkan keseluruhan data pada tabel user
$router->post('/User/store', 'PenggunaController@store');//menginput data baru pada tabel user
$router->get('/User/{id}', 'PenggunaController@show');//mencari data user berdasarkan id
$router->put('/User/update/{id}', 'PenggunaController@update');// update data user berdasarkan id user
$router->get('/User/delete/{id}', 'PenggunaController@destroy');//delete data user berdasarkan id user

//ENDPOINT UNTUK TABEL content PADA DATABASE cancer_registry
$router->get('/Content', 'KontenController@index');//menampilkan keseluruhan data pada tabel content
$router->post('/Content/store', 'KontenController@store');//menginput data baru pada tabel content
$router->get('/Content/{judul}', 'KontenController@show');//mencari data content berdasarkan id content
$router->put('/Content/update/{id}', 'KontenController@update');// update data content berdasarkan id content
$router->get('/Content/delete/{id}', 'KontenController@destroy');//delete data content berdasarkan id content

//ENDPOINT UNTUK TABEL faq PADA DATABASE cancer_registry
$router->get('/FAQ', 'FaqController@index');//menampilkan keseluruhan data pada tabel FAQ
$router->post('/FAQ/store', 'FaqController@store');//menginput data baru pada tabel FAQ
$router->get('/FAQ/{id}', 'FaqController@show');//mencari data FAQ berdasarkan id FAQ
$router->put('/FAQ/update/{id}', 'FaqController@update');// update data FAQ berdasarkan id FAQ
$router->get('/FAQ/delete/{id}', 'FaqController@destroy');//delete data FAQ berdasarkan id FAQ

//ENDPOINT UNTUK TABEL gejala PADA DATABASE cancer_registry
$router->get('/Symptom', 'GejalaController@index');//menampilkan keseluruhan data pada tabel gejala pasien
$router->post('/Symptom/store', 'GejalaController@store');//menginput data baru pada tabel gejala pasien
$router->get('/Symptom/{no_rekam_medis}', 'GejalaController@show');//mencari data gejala pasien berdasarkan no rekam medis dan id pasien
$router->put('/Symptom/update/{id}', 'GejalaController@update');// update data gejala pasien berdasarkan id pasien
$router->get('/Symptom/delete/{no_rekam_medis}', 'GejalaController@destroy');//delete data gejala pasien berdasarkan no rekam medis pasien

//ENDPOINT UNTUK TABEL jadwal PADA DATABASE cancer_registry
$router->get('/Appointment', 'JadwalController@index');//menampilkan keseluruhan data pada tabel jadwal check-up
$router->post('/Appointment/store', 'JadwalController@store');//menginput data baru pada tabel jadwal check-up
$router->get('/Appointment/{no_rekam_medis}', 'JadwalController@show');//mencari data jadwal check-up pasien berdasarkan no rekam medis dan id pasien
$router->put('/Appointment/update/{id}', 'JadwalController@update');// update data jadwal check-up pasien berdasarkan id pasien
$router->get('/Appointment/delete/{no_rekam_medis}', 'JadwalController@destroy');//delete data jadwal check-up pasien berdasarkan no rekam medis pasien

//ENDPOINT NOTIFIKASI CHECKUP
$router->get('/CommunicationRequest', 'NotifikasiController@notifikasi'); //menampilkan reminder checkup pasien

//ENDPOINT LOGIN
$router->post('/login', 'LoginController@ceklogin'); //membuat token untuk user login dengan menggunakan email dan password
$router->post('/logout', 'LoginController@logout'); //untuk logout user dari sistem 

//IMPORT FILE EXCEL
$router->post('/import/Condition', 'ImportsController@diagnosis'); //untuk import file excel ke table database diagnosis
$router->post('/import/Patient', 'ImportsController@profile'); //untuk import file excel ke table database profile
$router->post('/import/DiagnosticReport', 'ImportsController@histori'); //untuk import file excel ke table database histori
$router->post('/import/Referral', 'ImportsController@rujukan'); //untuk import file excel ke table database rujukan
$router->post('/import/Observation', 'ImportsController@rekmed'); //untuk import file excel ke table database rekmed

//EXPORT DATABASE KE EXCEL
$router->get('/export/Patient', 'ExcelExportController@expprofile'); //untuk export tabel profile pasien dari database ke Excel
$router->get('/export/Condition', 'ExcelExportController@expdiagnosis'); //untuk export tabel diagnosis pasien dari database ke Excel
$router->get('/export/DiagnosticReport', 'ExcelExportController@exphistori'); //untuk export tabel histori pasien dari database ke Excel
$router->get('/export/Observation', 'ExcelExportController@exprekam'); //untuk export tabel rekam medis pasien dari database ke Excel
$router->get('/export/Referral', 'ExcelExportController@exprujukan'); //untuk export tabel rujukan pasien dari database ke Excel
$router->get('/export/Symptom', 'ExcelExportController@expgejala'); //untuk export tabel gejala pasien dari database ke Excel