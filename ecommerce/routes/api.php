<?php
Route::group(['prefix' => 'v1'], function() {
    Route::post('/register', 'Api\v1\AuthController@register')->name('api.v1.register');

    Route::post('/login', 'Api\v1\AuthController@login')->name('api.v1.login');

    Route::group(['middleware' => ['jwt.auth']], function() {
        Route::post('/logout', 'Api\v1\AuthController@logout')->name('api.v1.logout');

        Route::get('users', 'Api\v1\UserController@index')->name('api.v1.users.index');
        Route::post('users', 'Api\v1\UserController@store')->name('api.v1.users.store');

        Route::get('categories', 'Api\v1\CategoryController@index')->name('api.v1.categories.index');

        Route::apiResource('products', 'Api\v1\ProductController', ['as' => 'api.v1']);
    });
});
