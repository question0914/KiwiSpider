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


Route::get('/beginSearch', function () { return view('searching.begin'); });
Route::get('/about', function () { return view('searching.about'); });





/* ------ Admin Route -----------*/
Route::get('admin/home',				'AdminController@index');
Route::get('admin',						'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin',					'Admin\LoginController@login');
Route::post('admin-password/email',		'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::post('admin-password/reset',		'Admin\ResetPasswordController@reset');
Route::get('admin-password/reset',	'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::get('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

/* ----- Admin Manage User Controller ------- */
Route::resource('/api/admin/get_user',				'Admin\UserAccController');
Route::get('/api/admin/useracc/remove/{id}',		'Admin\UserAccController@destroy');
Route::post('/api/admin/useracc/add',				'Admin\UserAccController@add');

/* ----- Admin Task Controller ------- */
Route::resource('/api/admin/task/get_task',			'Admin\TaskController');
Route::get('/api/admin/task/remove/{id}',			'Admin\TaskController@destroy');
Route::post('/api/admin/task/add',					'Admin\TaskController@add');
Route::post('/api/admin/task/edit',					'Admin\TaskController@edit');

/* ----- Admin Message Controller ------- */
Route::post('/api/admin/msg/get_task_messages',		'Admin\MessageController@get_task_messages');
Route::post('/api/admin/msg/send_message',			'Admin\MessageController@send_message');
Route::post('/api/admin/msg/delete_message',		'Admin\MessageController@delete_message');

/* ----- User Controller ------- */
Route::get('/api/user/get_your_account',			'HomeController@get_your_account');
Route::get('/api/user/get_user',					'HomeController@get_user');

/* ----- User Task Create Controller ------- */
Route::get('/api/user/task/get_create_task',		'User\TaskController@get_create_task');
Route::get('/api/user/task/create_remove/{id}',		'User\TaskController@create_destroy');
Route::post('/api/user/task/add',					'User\TaskController@add');
Route::post('/api/user/task/edit',					'User\TaskController@edit');

/* ----- User Your Task Controller ------- */
Route::get('/api/user/task/get_your_task',			'User\TaskController@get_your_task');
Route::get('/api/user/task/your_remove/{id}',		'User\TaskController@your_destroy');
Route::get('/api/user/task/your_complete/{id}',		'User\TaskController@your_complete');
Route::post('/api/user/task/your_progress_edit',	'User\TaskController@your_progress_edit');

/* ----- User Message Controller ------- */
Route::post('/api/user/msg/get_task_messages',		'User\MessageController@get_task_messages');
Route::post('/api/user/msg/send_message',			'User\MessageController@send_message');
Route::post('/api/user/msg/delete_message',			'User\MessageController@delete_message');


