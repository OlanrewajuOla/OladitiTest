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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/RegisterLevel', 'HomeController@RegisterLevel');
Route::get('/printsemester', 'HomeController@printsemester');

Route::get('/semester', 'HomeController@semester');

Route::get('/course', 'HomeController@course');

Route::get('/RegCourse', 'HomeController@RegCourse');

Route::get('/printingpage', 'HomeController@printingpage');

Route::get('/AllCourse', 'HomeController@AllCourse');

Route::get('/edit/{id}','HomeController@edit');

Route::get('/delete/{id}','HomeController@delete');

Route::get('/deletelecturer/{lecturers_id}','HomeController@deletelecturer');

Route::post('/course', 'HomeController@course');

Route::get('/courses', 'HomeController@courses');
Route::get('/selectedbysemester', 'HomeController@selectedbysemester');

Route::get('/print', 'HomeController@print');

Route::get('/allocatedcourse', 'HomeController@allocatedcourse');

Route::get('/RegLecturer', 'HomeController@RegLecturer');

Route::get('/jointable_course', 'HomeController@jointable_course');

Route::get('/editlecturer/{lecturers_id}', 'HomeController@editlecturer');

Route::get('/allocatedDelete/{allocated_id}', 'HomeController@allocatedDelete');

Route::get('/AllLecturer', 'HomeController@AllLecturer');

Route::post('/courses', 'HomeController@courses');

//Route::GET('/selectsemester', 'HomeController@selectsemester');

Route::post('/selectsemester', 'HomeController@selectsemester');

Route::post('/printingbysemester', 'HomeController@printingbysemester');

Route::post('/printing', 'HomeController@printing');

Route::post('/levelandstream', 'HomeController@levelandstream');

Route::post('/printingpage', 'HomeController@printingpage');

Route::post('/deletedallocatedcourses', 'HomeController@deletedallocatedcourses');

Route::post('/allocate', 'HomeController@allocate');

Route::post('/submitcourse', 'HomeController@submitcourse');

Route::post('/updatecourse', 'HomeController@updatecourse');

Route::post('/submitlecturer', 'HomeController@submitlecturer');

Route::post('/updatelecturer', 'HomeController@updatelecturer');




