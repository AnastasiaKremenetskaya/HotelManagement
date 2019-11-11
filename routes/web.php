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
})->name('welcome');

Route::get('/home', 'StaticPagesController@index')->name('home');

Route::get('/index', function () {
    return view('booking_info');
})->name('index');

Route::get('/rooms', 'RoomController@index')->name('rooms');

Auth::routes();

//Route::get('/reservation', 'ReservationController@inde')->name('reservation');

Route::get('reservations/create/{id_room}', 'ReservationController@create')->name('reservations.create');

Route::resource('/reservations', 'ReservationController', [
    'names' => [
        'index' => 'reservations.index',
        'show' => 'reservations.show',
        'update' => 'reservations.update',
        'edit' => 'reservations.edit',
        'store' => 'reservations.store',
        'destroy' => 'reservations.destroy',
    ],
    'parameters' => [
        'id_room' => 'id_room'
    ]
])->except('create');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', 'StaticPagesController@admin')->name("mainAdminPage");

    Route::resource('/reservations', 'Admin\ReservationController', [
        'names' => [
            'index' => 'reservations.index',
            'show' => 'reservations.show',
            'create' => 'reservations.create',
            'update' => 'reservations.update',
            'edit' => 'reservations.edit',
            'store' => 'reservations.store',
            'destroy' => 'reservations.destroy',
        ],
        'parameters' => [
            'reservation' => 'id_reservation'
        ]
    ]);

    Route::resource('/users', 'UsersController', [
        'names' => [
            'index' => 'users.index',
            'show' => 'users.show',
            'create' => 'users.create',
            'update' => 'users.update',
            'edit' => 'users.edit',
            'store' => 'users.store',
            'destroy' => 'users.destroy',
        ],
        'parameters' => [
            'user' => 'id_user'
        ]
    ]);

    Route::resource('/staff', 'Admin\StaffController', [
        'names' => [
            'index' => 'staff.index',
            'show' => 'staff.show',
            'create' => 'staff.create',
            'update' => 'staff.update',
            'edit' => 'staff.edit',
            'store' => 'staff.store',
            'destroy' => 'staff.destroy',
        ],
        'parameters' => [
            'staff' => 'id_staff'
        ]
    ]);
});

Route::get('/home', 'HomeController@index')->name('home');
