<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Infeeds
    Route::delete('infeeds/destroy', 'InfeedController@massDestroy')->name('infeeds.massDestroy');
    Route::resource('infeeds', 'InfeedController');
    Route::get('last', 'InfeedController@last')->name('infeeds.last');
    Route::get('costlasthour', 'InfeedController@costlasthour')->name('infeeds.costlasthour');

    // Tplinks
    Route::delete('tplinks/destroy', 'TplinkController@massDestroy')->name('tplinks.massDestroy');
    Route::resource('tplinks', 'TplinkController');

    // Tplink Devices
    Route::delete('tplink-devices/destroy', 'TplinkDevicesController@massDestroy')->name('tplink-devices.massDestroy');
    Route::resource('tplink-devices', 'TplinkDevicesController');

    // Configs
    Route::delete('configs/destroy', 'ConfigController@massDestroy')->name('configs.massDestroy');
    Route::resource('configs', 'ConfigController');
});
