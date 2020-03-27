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

Route::get('/', 'SpecialtyController@index')->name('home');
Route::get('/ProfissionaisPorEspecialidade/{specialty_id}', 'SpecialtyController@listProfessionals')->name('ProfBySpec');
Route::post('/Agendar', 'ScheduleController@create')->name('Schedule.Form');
Route::get('/AgendarAcao', 'ScheduleController@store')->name('Schedule.Do');




