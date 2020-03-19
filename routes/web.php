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
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function(){
	
Route::get('/estate', 'bookingController@estate_dashboard')->name('estate_dashboard');
Route::get('/approval', 'bookingController@approval')->name('approval');
Route::get('/sendmail', 'bookingController@mail')->name('mail');
Route::get('/student_list', 'bookingController@student_list')->name('student_list');
Route::post('/student_list/approve/{id}', 'bookingController@approve')->name('student_list.approve');
Route::post('/student_list/reject/{id}', 'bookingController@reject')->name('student_list.reject');
Route::get('/reset', 'bookingController@reset')->name('reset');
Route::get('/resetPublic', 'bookingController@resetPublic')->name('resetPublic');


Route::get('/specificOffice', 'bookingController@specificOffice_dashboard')->name('specificOffice_dashboard');
Route::get('/DUR', 'bookingController@DUR_dashboard')->name('DUR_dashboard');
Route::get('/student', 'StudentController@create')->name('student');
Route::post('/student', 'StudentController@create')->name('student');
Route::get('/new_student', 'StudentController@index')->name('new_student');


Route::get('/hall_list', 'BedspaceController@index')->name('hall_list');
Route::get('/add_hall', 'BedspaceController@create')->name('add_hall');
Route::post('/store_hall', 'BedspaceController@store')->name('store_hall');
Route::get('/edit_hall/{id}', 'BedspaceController@edit')->name('edit_hall');
Route::post('/update_hall/{id}', 'BedspaceController@update')->name('update_hall');
Route::post('/delete_hall/{id}', 'BedspaceController@delete')->name('delete_hall');

 
// these are routes for facility
Route::get('/facility_list', 'FacilityController@index')->name('facility_list');
Route::get('/add_facility', 'FacilityController@create')->name('add_facility');
Route::post('/store_facility', 'FacilityController@store')->name('store_facility');
Route::get('/edit_facility/{id}', 'FacilityController@edit')->name('edit_facility');
Route::post('/update_public_facility/{id}', 'FacilityController@update')->name('update_public_facility');
Route::post('/delete_facility/{id}', 'FacilityController@delete')->name('delete_facility');

// routes for public user list.
Route::get('/public_user_list', 'bookingController@public_user_list')->name('public_user_list');
Route::post('/public_list/approve/{id}', 'bookingController@approve_public')->name('approve_public');
Route::post('/public_list/reject/{id}', 'bookingController@reject_public')->name('reject_public');

Route::get('/public_summary', 'bookingController@public_summary')->name('public_summary');

Route::get('/developers', 'bookingController@developers')->name('developers');


// routes for system admin dashboard starts here

Route::get('/admin', 'bookingController@admin_dashboard')->name('admin_dashboard');
Route::get('/admin_student_list', 'bookingController@admin_student_list')->name('admin_student_list');
Route::get('/admin_public_user_list', 'bookingController@admin_public_user_list')->name('admin_public_user_list');
Route::get('/admin_public_summary', 'bookingController@admin_public_summary')->name('admin_public_summary');
Route::get('/admin_estate_users', 'bookingController@admin_estate_users')->name('admin_estate_users');
Route::get('/admin_students', 'bookingController@admin_students')->name('admin_students');
Route::post('/delete_user', 'bookingController@delete_user')->name('delete_user');
Route::post('/add_user', 'bookingController@add_user')->name('add_user');
Route::get('/add_user', 'bookingController@add_user')->name('add_user');
Route::get('/admin_programmes', 'bookingController@admin_programmes')->name('admin_programmes');
Route::post('/delete_prog', 'bookingController@delete_prog')->name('delete_prog');
Route::post('/admin_programme_edit', 'bookingController@admin_programme_edit')->name('admin_programme_edit');
Route::post('/admin_email_edit', 'bookingController@admin_email_edit')->name('admin_email_edit');

Route::post('/admin_import_programmes', 'bookingController@admin_import_programmes')->name('admin_import_programmes');

Route::post('/import', 'bookingController@admin_import_students')->name('admin_import_students');
Route::post('/edit_student', 'bookingController@admin_students_edit')->name('admin_students_edit');

       
   // these are routes for bedspace
Route::get('/admin_add_hall', 'BedspaceController@admin_create')->name('admin_add_hall');
Route::get('/admin_hall_list', 'BedspaceController@admin_index')->name('admin_hall_list');
Route::post('/admin_store_hall', 'BedspaceController@admin_store')->name('admin_store_hall');
Route::get('/admin_edit_hall/{id}', 'BedspaceController@admin_edit')->name('admin_edit_hall');
Route::post('/admin_update_hall/{id}', 'BedspaceController@admin_update')->name('admin_update_hall');
Route::post('/admin_delete_hall/{id}', 'BedspaceController@admin_delete')->name('admin_delete_hall');
Route::post('/admin_import_bedspace', 'BedspaceController@admin_import_bedspace')->name('admin_import_bedspace');

   // these are routes for facility
Route::get('/admin_facility_list', 'FacilityController@admin_index')->name('admin_facility_list');
Route::get('/admin_add_facility', 'FacilityController@admin_create')->name('admin_add_facility');
Route::post('/admin_store_facility', 'FacilityController@admin_store')->name('admin_store_facility');
Route::get('/admin_edit_facility/{id}', 'FacilityController@admin_edit')->name('admin_edit_facility');
Route::post('/admin_update_public_facility/{id}', 'FacilityController@admin_update')->name('admin_update_public_facility');
Route::post('/admin_delete_facility/{id}', 'FacilityController@admin_delete')->name('admin_delete_facility');


// routes for system admin dashboard starts here


});

Route::get('/auth_public_user', 'PublicController@logged_in')->name('logged_in');
Route::post('/auth_public_user', 'PublicController@logged_in')->name('logged_in');

Route::get('/first_year', 'StudentController@first_year')->name('first_year');
Route::post('/first_year', 'StudentController@first_year')->name('first_year');


Route::get('/booking', 'PublicController@form')->name('form');
Route::get('/public_facility', 'PublicController@select_facility')->name('select_facility');
Route::post('/public_facility', 'PublicController@select_facility')->name('select_facility');
Route::post('/update_facility', 'PublicController@update_facility')->name('update_facility');
Route::get('/upload_deposit_slip', 'PublicController@upload_deposit_slip')->name('upload_deposit_slip');
Route::post('/upload_deposit_slip', 'PublicController@upload_deposit_slip')->name('upload_deposit_slip');


Auth::routes();


