<?php

$factory->define(App\Device::class, function (Faker\Generator $faker) {
    return [
        'ip' =>  $faker->randomNumber(3) ,
        'location' =>  $faker->word ,
        'position' =>  $faker->word ,
        'rh_max' => 55.6 ,
        'rh_min' => 45.5 ,
        'temp_max' => 25.6 ,
        'temp_min' => 20.5
    ];
});

$factory->define(App\Monitor::class, function (Faker\Generator $faker) {
    return [
        'rh' =>  $faker->word ,
        'temp' =>  $faker->word ,
        'is_recording' =>  $faker->word ,
        'device_id' =>  function(){ return factory(\App\Device::class)->create()->id; } ,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' =>  $faker->name ,
        'employee_id' =>  $faker->randomNumber() ,
        'email' =>  $faker->safeEmail ,
        'password' =>  bcrypt($faker->password) ,
        'is_admin' =>  0 ,
        'remember_token' =>  str_random(10) ,
    ];
});

$factory->define(App\Configuration::class, function () {
    return [
        'fake_reading' =>  1 ,
        'hide_offline' =>  1 ,
        'refreshing_time' =>  60  ,
        'user_id' => function() {
            return factory(\App\User::class)->create()->id;
        }
    ];
});

