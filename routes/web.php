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

Route::get('/', 'ImportController@showImport');

Route::post('/import', 'ImportController@import');

Route::get('/test', function(){
	try {
			CT400::create([
				'first_name'=> 'Chudi',
				'last_name'=>'Oranu',
				'level'=>400,
				'matric_no'=>'14/1290',
				'course'=>'Computer Tech',
				'password'=>strtolower(str_random(4)),
			]);
	} catch(QueryException $e){
		if($e->errorInfo[1]==1062){
			$errorMessage = $e->errorInfo[2];
			$show = preg_match('/..(\/)..../', $errorMessage, $result);
			echo 'Oops! Duplicate Entry for the Matric Number: '.$result[0];
		}
	}
});
