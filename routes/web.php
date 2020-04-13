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

Route::get('/', function () {
    return view('pages.dashboard.dashboard');
});
Route::resource('clinic', 'ClinicController');
Route::resource('doctor', 'DoctorController');
Route::resource('patient','PatientController');
Route::get('clinic/destroy/{id}', [
	'as' => 'clinic.destroy', 
	'uses' => 'ClinicController@destroy'
]);
Route::get('doctor/destroy/{id}', [
	'as' => 'doctor.destroy', 
	'uses' => 'DoctorController@destroy'
]);
Route::get('patient/destroy/{id}', [
	'as' => 'patient.destroy', 
	'uses' => 'PatientController@destroy'
]);
Route::post('patient/getDoctors', 'PatientController@getDoctors');
