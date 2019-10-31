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

Route::get('/index', function () {
    return view('booking_info');
})->name('index');

Route::get('/rooms', 'StaticPagesController@index')->name('rooms');

Auth::routes();

Route::get('/home', 'StaticPagesController@index')->name('home');

Route::get('/reservation', 'StaticPagesController@reservation')->name('reservation');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth', 'verified', 'role:admin'], function() {
    Route::view('/', 'dashboard/dashboard');
    Route::get('reservations/create/{id}', 'ReservationController@create');
    Route::resource('reservations', 'ReservationController')->except('create');
});

Route::group(['prefix'=>'admin'], function(){
    Route::get('/', 'StaticPagesController@admin')->name("mainAdminPage");
});

Route::resource('/reservations', 'ReservationController', [
    'name' => [
        'index' => 'reservation.index',
        'show' => 'reservation.show',
        'create' => 'reservation.create',
        'update' => 'reservation.update',
        'edit' => 'reservation.edit',
        'store' => 'reservation.store',
        'destroy' => 'reservation.destroy',
    ],
    'parameters' => [
        'reservation' => 'id_reservation'
    ]
]);


