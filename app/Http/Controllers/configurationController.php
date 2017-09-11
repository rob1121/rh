<?php namespace App\Http\Controllers;

use App\Configuration;
use App\Http\Requests\ConfigurationRequest;
use Illuminate\Support\Facades\Auth;

class configurationController extends Controller
{

    public function update(ConfigurationRequest $request)
    {
        $instance = Configuration::instance($request->all());
        Auth::user()->config()->update($instance);
    }
}