<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| @Description : Application All Routes without api.
| @Author : IDDL.
| @Email  : tarekmonjur@gmail.com
|
*/

Route::get('/','DashboardController');


/*
* Users Login-Logout Routes
*/
Route::get('login','Auth\LoginController@showLogin')->name('login');
Route::post('login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout');


/*
 * Forgot & Reset Password Route
 */
Route::group(['prefix' => 'password'],function(){
    Route::get('forgot','Auth\ForgotPasswordController@showMailSend');
    Route::post('sendmail','Auth\ForgotPasswordController@sendMail');
    Route::get('reset/{token}/{email}','Auth\ResetPasswordController@showResetPassword');
    Route::post('reset','Auth\ResetPasswordController@resetPassword');
});


/*
 * Users routes.
 */
Route::group(['prefix'=>'users'],function(){
    Route::get('/','User\UserController');
    Route::get('create','Auth\RegisterController@showRegister');
    Route::post('create','Auth\RegisterController@register');
    Route::get('{id}/edit','User\UserController@edit');
    Route::put('{id}','User\UserController@update');
    Route::get('{id}/delete','User\UserController@delete');
});

/*
 * Role Permission routes.
 */
Route::resource('roles', 'User\RolePermissionController');

/*
 * Company routes.
 */
Route::resource('company', 'Company\CompanyController');

/*
 * Department routes.
 */
Route::resource('department', 'Company\DepartmentController');

/*
 * Teams routes.
 */
Route::resource('teams', 'User\TeamController');

/*
 * Project routes.
 */
Route::resource('projects', 'Project\ProjectController');

/*
 * Story routes.
 */
Route::resource('projects/{project}/stories', 'Project\StoryController');

/*
 * Task routes.
 */
Route::resource('projects/{project}/stories/{story}/tasks', 'Task\TaskController');
Route::get('projects/{project}/stories/{story}/tasks/{task}/tracking/{status}', 'Task\TaskController@taskWorkTracking');

/*
 * Task Comment routes.
 */
Route::resource('tasks/{task}/comments', 'Task\CommentController');

Route::post('projects/document', 'DocumentController@documentUpload');
Route::post('stories/document', 'DocumentController@documentUpload');
Route::post('tasks/document', 'DocumentController@documentUpload');

Route::delete('projects/document/{id}', 'DocumentController@destroy');
Route::delete('stories/document/{id}', 'DocumentController@destroy');
Route::delete('tasks/document/{id}', 'DocumentController@destroy');



























