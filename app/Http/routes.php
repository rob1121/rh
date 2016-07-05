<?php

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('/status', 'HomeController@status');

