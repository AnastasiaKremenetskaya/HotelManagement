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
    Route::group(['as' => 'charts.', 'prefix' => 'charts'], function () {
        Route::get('/avg_salary', 'Admin\ChartsController@avg_salary')->name('avg_salary');
        Route::get('/avg_rooms_sum', 'Admin\ChartsController@avg_rooms_sum')->name('avg_rooms_sum');
    });

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
            'users' => 'id'
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
            'staff' => 'id'
        ]
    ]);

    Route::resource('/inventories', 'Admin\InventoriesController', [
        'names' => [
            'index' => 'inventories.index',
            'show' => 'inventories.show',
            'create' => 'inventories.create',
            'update' => 'inventories.update',
            'edit' => 'inventories.edit',
            'store' => 'inventories.store',
            'destroy' => 'inventories.destroy',
        ],
        'parameters' => [
            'inventories' => 'id'
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

    Route::resource('/rooms', 'Admin\RoomsController', [
        'names' => [
            'index' => 'rooms.index',
            'show' => 'rooms.show',
            'create' => 'rooms.create',
            'update' => 'rooms.update',
            'edit' => 'rooms.edit',
            'store' => 'rooms.store',
            'destroy' => 'rooms.destroy',
        ],
        'parameters' => [
            'rooms' => 'id'
        ]
    ]);

    Route::resource('/administrators', 'Admin\AdministratorsController', [
        'names' => [
            'index' => 'administrators.index',
            'show' => 'administrators.show',
            'create' => 'administrators.create',
            'update' => 'administrators.update',
            'edit' => 'administrators.edit',
            'store' => 'administrators.store',
            'destroy' => 'administrators.destroy',
        ],
        'parameters' => [
            'administrators' => 'id'
        ]
    ]);

    Route::resource('/cleaners', 'Admin\CleanersController', [
        'names' => [
            'index' => 'cleaners.index',
            'show' => 'cleaners.show',
            'create' => 'cleaners.create',
            'update' => 'cleaners.update',
            'edit' => 'cleaners.edit',
            'store' => 'cleaners.store',
            'destroy' => 'cleaners.destroy',
        ],
        'parameters' => [
            'cleaners' => 'id'
        ]
    ]);

});

Route::get('/home', 'HomeController@index')->name('home');
