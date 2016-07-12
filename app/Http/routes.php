<?php

Route::auth();

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('/status', 'HomeController@status'); //ajax request

Route::get('/devices',[
    'as' => 'devices',
    'uses' => 'DeviceController@show'
]);

Route::get('/export',[
    'as' => 'exportToCsv',
    'uses' => 'DeviceController@exportToCsv'
]); //export db to excel

Route::post('devices',[
    'as' => 'store_device',
    'uses' => 'DeviceController@store'
]);

Route::post('/update/{device}',[
    'as' => 'update_device',
    'uses' => 'DeviceController@update'
]);

Route::post('/delete/{device}',[
    'as' => 'delete_device',
    'uses' => 'DeviceController@delete'
]);

