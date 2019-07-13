<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Config::set('auth.defines', 'admin'); // to change defualt guard from web to admin @config/auth.php

    Route::get('/login', 'AdminAuth@login_get');
    Route::post('/login', 'AdminAuth@login_post');

    Route::group(['prefix' => 'password'], function () {
        Route::get('forgot', 'AdminResetPassword@forgot_password_view');
        Route::post('forgot', 'AdminResetPassword@forgot_password_post');
        Route::get('reset/{token}', 'AdminResetPassword@reset_password_view');
        Route::post('reset/{token}', 'AdminResetPassword@reset_password');
    });

    Route::group(['middleware' => 'admin:admin'], function () {
        // here ...... Admin must be authentcated
        Route::any('/', 'AdminAuth@index');
        Route::any('logout', 'AdminAuth@logout');
        Route::resource('admins', 'AdminController');
        Route::delete('admins/destroy/all', 'AdminController@multi_delete');

        Route::resource('users', 'UsersController');
        Route::delete('users/destroy/all', 'UsersController@multi_delete');

        Route::get('settings', 'Settings@setting');
        Route::post('settings', 'Settings@setting_save');

        Route::get('lang/{lang}','AdminController@setLang');

        Route::resource('countries', 'CountriesController');
        Route::delete('countries/destroy/all', 'CountriesController@multi_delete');

        Route::resource('cities', 'CitiesController');
        Route::delete('cities/destroy/all', 'CitiesController@multi_delete');

        Route::resource('states', 'StatesController');
        Route::delete('states/destroy/all', 'StatesController@multi_delete');

        Route::resource('trademarks', 'TradeMarksController');
        Route::delete('trademarks/destroy/all', 'TradeMarksController@multi_delete');

        Route::resource('manufactures', 'ManufacturesController');
        Route::delete('manufactures/destroy/all', 'ManufacturesController@multi_delete');

        Route::resource('departments', 'DepartmentsController');
        Route::delete('departments/destroy/all', 'DepartmentsController@multi_delete');

    }); // End Route middleware admin

}); // End Route group admin

