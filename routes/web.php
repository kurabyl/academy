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



Auth::routes();

Route::get('/', 'HomeController@check');
Route::get('/home', 'HomeController@check');

Route::prefix('student')->group(function(){
    Route::get('/', 'StudentController@index');
    Route::get('course/list/{id}','Course\CourseController@list');
    Route::get('course/more/{id}','Course\CourseController@more');
    Route::get('section/{id}','Section\SectionController@show');
    Route::get('profile','StudentController@profile');
    Route::get('buy/course','StudentController@buyCourse');
    Route::post('send/buy/course','Course\CourseController@buyCourse')->name('buy_course');
    Route::post('profile/changedetails','StudentController@changeDetails')->name('change_details');
    Route::get('mycourse','StudentController@myCourse');
});

Route::prefix('admin')->group(function(){

    //Get Requests
    Route::get('/', 'Admin\AdminController@index');
    Route::get('/sections','Admin\ShowController@showSections');
    Route::get('/course',  'Admin\ShowController@showCourse');
    Route::get('/students','Admin\ShowController@showStudents');

    Route::get('/applications','Admin\ShowController@showApplications');

    Route::get('/section/edit/{id}','Admin\ShowController@editSections');
    Route::get('/course/edit/{id}','Admin\ShowController@editCourse');
    Route::get('/course/view/{id}','Admin\ShowController@showVideoCourse');
    Route::get('/applications/active/{id}','Admin\ShowController@showActiveApplications');
    Route::get('/applications/deactive/{id}/course/{course_id}','Admin\ShowController@showDectiveApplications');
    Route::get('/videocourse/add','Admin\ShowController@showAddVideoCourse');
    Route::get('/videocourse/edit/{id}','Admin\ShowController@editVideoCourse');


    //Post Requests Section
    Route::post('section/add','Admin\AdminController@addSection')->name('add_section');
    Route::post('section/edit','Admin\AdminController@editSection')->name('edit_section');

    //Post Requests Course
    Route::post('course/add','Admin\CourseController@add')->name('add_course');
    Route::post('course/edit','Admin\CourseController@edit')->name('edit_course');


    Route::post('videcourse/add','Admin\CourseController@addVideo')->name('add_videocourse');
    Route::post('videocourse/edit','Admin\CourseController@editVideo')->name('edit_videocourse');
    Route::post('application/active','Admin\CourseController@activeCourse')->name('active_application');
});



Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
})->name('logout');
Route::get('reset','Auth\ResetPasswordController@show');
Route::post('resetpassword','Auth\ResetPasswordController@reset')->name('resetpassword');
