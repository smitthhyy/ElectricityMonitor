<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Infeeds
    Route::apiResource('infeeds', 'InfeedApiController');

    // Tplinks
    Route::apiResource('tplinks', 'TplinkApiController');

    // Tplink Devices
    Route::apiResource('tplink-devices', 'TplinkDevicesApiController');

    // Configs
    Route::apiResource('configs', 'ConfigApiController');
});
