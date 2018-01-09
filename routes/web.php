<?php

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

use App\CT400;
use Illuminate\Database\QueryException;

Route::get('/import', 'ImportController@showImport');

Route::post('/import', 'ImportController@import');

Route::get('/fetch/student', 'FetchController@showFetch');

Route::post('/fetch/student', 'FetchController@fetchDetails');

Route::get('/fetch/course/{course}', 'FetchController@fetchCourse');

