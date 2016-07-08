<?php

Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/status', 'HomeController@status'); //ajax request

Route::get('/export',[
    'as' => 'exportToCsv',
    'uses' => 'HomeController@exportToExcel'
]); //export db to excel

