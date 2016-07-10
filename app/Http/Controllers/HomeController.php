<?php

namespace App\Http\Controllers;

use App\omega\models\device;
use JavaScript;
use App\Http\Requests;
use App\omega\Repo\StatusRepository;

class HomeController extends Controller
{
    public function index()
    {
        JavaScript::put(["omegas" => device::all()]);
        return view('welcome');
    }

    public function status(StatusRepository $omega)
    {
    	return device::all()->map(function($item) use($omega){
    		return $omega->statusOf($item);
    	});
    }
}
