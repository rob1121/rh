<?php

Route::get("/", function () {
    return view("welcome");
});

Auth::routes();

Route::get("/api/v1/users", [
    "as" => "api.users.index",
    "uses" => 'Api\UserController@index'
]);

Route::post("/api/v1/users/", [
    "as" => "api.users.store",
    "uses" => 'Api\UserController@store'
]);

Route::put("/api/v1/users/{user}", [
    "as" => "api.users.update",
    "uses" => 'Api\UserController@update'
]);

Route::delete("/api/v1/users/{user}", [
    "as" => "api.users.delete",
    "uses" => 'Api\UserController@destroy'
]);

Route::get("/user", [
    "as" => "user.index",
    "uses" => "UserController@index"
]);

Route::get("/home", "HomeController@index");


Route::get("/monitor", [
    "as" => "monitor.index",
    "uses" => "monitorController@index"
]);

Route::get("/device", [
    "as" => "device.index",
    "uses" => "deviceController@index"
]);

Route::get("/api/v1/devices", [
    "as" => "api.devices",
    "uses" => 'Api\deviceController@index'
]);

Route::post("/api/v1/devices", [
    "as" => "api.devices.store",
    "uses" => 'Api\deviceController@store'
]);

Route::put("/api/v1/devices/{device}", [
    "as" => "api.devices.update",
    "uses" => 'Api\deviceController@update'
]);

Route::post("/api/v1/devices/update-positions", [
    "as" => "api.devices.update_position",
    "uses" => 'Api\deviceController@updatePositions'
]);

Route::delete("/api/v1/devices/{device}", [
    "as" => "api.devices.delete",
    "uses" => 'Api\deviceController@destroy'
]);

Route::put("/configuration", [
    "as" => "configuration.update",
    "uses" => "configurationController@update"
]);

Route::get("/api/v1/excel/export/{from}/{to}",[
    "as" => "api.excel.export",
    "uses" => 'Api\exporterController@export'
]);

Route::get('/documentation', function() {
   return view('documentation.index');
});


Route::get("/api/v1/monitor/{device}/measurement", [
    "as" => "monitor.device.measurement",
    "uses" => "monitorController@getMeasurementOf"
]);