<?php

use App\Http\Controllers\admin\WinController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest', 'namespace' => 'admin'], function () {
    Route::get('', 'LoginController@index');
    Route::any('', 'LoginController@index')->name('admin_login');
    Route::post('main/checklogin', 'LoginController@checklogin');
    Route::get('register', 'LoginController@register')->name('register');
    Route::post('register', 'LoginController@store');
    Route::get('verify/{user:id}', 'LoginController@verify')->name('verify');
    Route::post('verify/{user:id}', 'LoginController@verifyed');
    Route::get('resend/{user:id}', 'LoginController@resend')->name('resend');
});
Route::group(['middleware' => 'auth', 'namespace' => 'admin'], function () {

    // Dashboard
    Route::get('', 'DashboardController@index');
    Route::get('/home', 'DashboardController@index')->name('admin_home');

    // User 
    Route::post('user/delete', 'UsersController@destroyAll');
    Route::get('user/status/{user:id}', 'UsersController@status')->name('user.status');
    Route::post('state/delete', 'StateController@destroyAll');
    Route::post('city/delete', 'CityController@destroyAll');
    Route::post('role/delete', 'RoleController@destroyAll');

    Route::get('search/order', 'OrderController@search')->name('order.search');
    Route::get('export/order', 'OrderController@export')->name('order.export');

    Route::post('order/delete', 'OrderController@destroyAll');
    Route::get('order/status/{order}', 'OrderController@change_status')->name('order_status');

    Route::get('order/status/{id}', 'OrderController@changestatus');
    Route::get('order/pdf/{id}', 'OrderController@invoicepdf');

    // Master 
    Route::resources([
        'state'        => 'StateController',
        'city'         => 'CityController',
        'role'         => 'RoleController',
        'order'      => 'OrderController',
        'user'         => 'UsersController',
    ]);

    // setting 
    Route::resource('setting', 'SettingController');
    Route::get('logout', 'LoginController@logout')->name('admin_logout');
});
