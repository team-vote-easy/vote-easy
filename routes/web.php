<?php

Route::get('admin-create','AdminController@create');

Route::get('admin-log', 'AdminController@showLogin');

Route::post('admin-log', 'AdminController@login');

Route::get('admin-logout', 'AdminController@logout');

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

	Route::get('/view-votes-senators', 'VoteController@senatorVotesView');

	Route::post('/view-votes-senators', 'VoteController@getSenatorVotes');

	Route::get('/get-total', 'AnalyticsController@getTotal');

	Route::get('/add-staff', 'StaffController@addStaffView');

	Route::post('/add-staff', 'StaffController@addStaff');

	Route::get('/view-staff', 'StaffController@viewStaffView');

	Route::post('/view-staff', 'StaffController@viewStaff');
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

	Route::post('/api/vote', 'StudentController@postVotes');

	Route::get('/api/get-candidates', 'StudentController@getCandidates');
});

Route::get('/serialize-test', 'StudentController@serializeTest');
Route::get('/unserialize-test', 'StudentController@unserializeTest');



/*--------------------------------------------------------------------------*/
Route::get('/staff/login', 'StaffController@staffLoginView')->middleware('redirectauthenticatedstaff');

Route::post('/staff/login', 'StaffController@login')->middleware('redirectauthenticatedstaff');

Route::group(["middleware"=>"staffauth"], function(){
	Route::get('/staff/home', 'StaffController@staffHome');

	Route::post('/staff/fetch-student', 'StaffController@fetchStudent');

	Route::get('/staff/view-breakdown', 'StaffController@breakDownView');

	Route::get('/staff/push-to-server', 'StaffController@pushToServerView');

	Route::post('/staff/push-to-server', 'StaffController@pushToServer');
	
	Route::get('/staff/logout', 'StaffController@logout');
});


