<?php

Route::get('admin-create','AdminController@create');

Route::get('admin-log', 'AdminController@showLogin');

Route::post('admin-log', 'AdminController@login');

Route::get('admin-logout', 'AdminController@logout');

Route::get('/admin-test', 'AdminController@testAuth');


Route::get('/add-test', 'ImportController@addTest');

Route::group(['middleware'=>'adminauth'], function(){

	Route::get('import', 'ImportController@showImport');

	Route::post('import', 'ImportController@import');

	Route::get('/add-student', 'ImportController@addStudentView');

	Route::post('/add-student', 'ImportController@addStudent');

	Route::get('add-candidates', 'AddController@showAdd');

	Route::post('add-candidates', 'AddController@add');

	Route::get('add-posts', 'AddController@addPostsView');

	Route::post('add-posts', 'AddController@addPosts');

	Route::get('fetch-course', 'FetchController@fetchCourseView');

	Route::post('fetch-hall', 'FetchController@fetchHall');

	Route::get('fetch-student', 'FetchController@fetchStudentView');

	Route::post('fetch-student', 'FetchController@fetchStudent');

	Route::get('fetch-candidates', 'FetchController@fetchCandidateView');

	Route::post('fetch-candidates', 'FetchController@fetchCandidate');

	Route::get('view-votes', 'VoteController@getVotesView');

	Route::get('api/get-votes', 'VoteController@getVotes');

	Route::get('/view-breakdown', 'AnalyticsController@breakDownView');
});


/*--------------------------------------------------------------------------*/

Route::get('/', function(){
	return redirect('/student-login');
});


Route::group(['middleware'=>'redirectauthenticatedstudents'], function(){
	Route::get('student-login', 'StudentController@loginView');

	Route::post('student-login', 'StudentController@login');
});


Route::group(['middleware'=>'studentauth'], function(){
	
	Route::get('vote', 'StudentController@voteView');

	Route::get('logout', 'StudentController@logout');

	Route::get('api/student', 'StudentController@getStudent');

	Route::get('api/candidates', 'StudentController@getCandidates');

	Route::post('/api/vote', 'StudentController@postVotes');

	Route::get('/api/student/get-candidates', 'StudentController@getCandidatesAPI');
});



Route::get('/get-total', 'AnalyticsController@getTotal');



