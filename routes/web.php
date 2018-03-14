<?php

Route::get('/', function(){
	return redirect('/import');
});


// Route::get('admin-dashboard', function(){
// 	return view('admin-dashboard');
// });

Route::get('import', 'ImportController@showImport');

Route::post('import', 'ImportController@import');

Route::get('/add-student', 'ImportController@addStudentView');

Route::post('/add-student', 'ImportController@addStudent');

Route::get('add-candidates', 'AddController@showAdd');

Route::post('add-candidates', 'AddController@add');

Route::get('add-posts', 'AddController@addPostsView');

Route::post('add-posts', 'AddController@addPosts');

Route::get('fetch-course', 'FetchController@fetchCourseView');

Route::post('fetch-course', 'FetchController@fetchCourse');

Route::get('fetch-student', 'FetchController@fetchStudentView');

Route::post('fetch-student', 'FetchController@fetchStudent');

Route::get('fetch-candidates', 'FetchController@fetchCandidateView');

Route::post('fetch-candidates', 'FetchController@fetchCandidate');


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
});




Route::get('view-votes', 'VoteController@getVotesView');

Route::get('api/get-votes', 'VoteController@getVotes');

Route::get('/vote-test', function(){
	return view('vote-test');
});



Route::get('my-test', 'VoteController@phpTest');

