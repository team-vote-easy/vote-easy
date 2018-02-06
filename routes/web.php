<?php

Route::get('import', 'ImportController@showImport');

Route::post('import', 'ImportController@import');

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


Route::get('student-login', 'StudentController@loginView');

Route::post('student-login', 'StudentController@login');

Route::group(['middleware'=>'studentauth'], function(){
	
	Route::get('vote', 'StudentController@voteView');

	Route::get('logout', 'StudentController@logout');

	Route::get('api/student', 'StudentController@getStudent');

	Route::get('api/candidates', 'StudentController@getCandidates');

	Route::post('/api/vote', 'StudentController@postVotes');

});

Route::get('view-votes', 'VoteController@test');



