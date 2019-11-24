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
            'reservations' => 'id_reservation'
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
            'users' => 'id_user'
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

    Route::resource('/roles', 'Admin\RolesController', [
        'names' => [
            'index' => 'roles.index',
            'show' => 'roles.show',
            'create' => 'roles.create',
            'update' => 'roles.update',
            'edit' => 'roles.edit',
            'store' => 'roles.store',
            'destroy' => 'roles.destroy',
        ],
        'parameters' => [
            'roles' => 'id_role'
        ]
    ]);

    Route::resource('/extra_services', 'Admin\ExtraServicesController', [
        'names' => [
            'index' => 'extra_services.index',
            'show' => 'extra_services.show',
            'create' => 'extra_services.create',
            'update' => 'extra_services.update',
            'edit' => 'extra_services.edit',
            'store' => 'extra_services.store',
            'destroy' => 'extra_services.destroy',
        ],
        'parameters' => [
            'extra_services' => 'id_extra_service'
        ]
    ]);

    Route::resource('/breakfasts', 'Admin\BreakfastsController', [
        'names' => [
            'index' => 'breakfasts.index',
            'show' => 'breakfasts.show',
            'create' => 'breakfasts.create',
            'update' => 'breakfasts.update',
            'edit' => 'breakfasts.edit',
            'store' => 'breakfasts.store',
            'destroy' => 'breakfasts.destroy',
        ],
        'parameters' => [
            'breakfasts' => 'id_breakfast'
        ]
    ]);

});

Route::get('/home', 'HomeController@index')->name('home');
