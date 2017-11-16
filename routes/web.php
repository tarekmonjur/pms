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
Route::group(['prefix'=>'user'],function(){
    Route::get('/','User\UserController');
    Route::get('create','Auth\RegisterController@showRegister');
    Route::post('create','Auth\RegisterController@register');
    Route::get('edit/{id}','User\UserController@edit');
    Route::post('edit','User\UserController@update');
    Route::get('delete/{id}','User\UserController@delete');
});





















