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

