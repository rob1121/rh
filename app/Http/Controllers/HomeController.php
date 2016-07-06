<?php

namespace App\Http\Controllers;

use JavaScript;
use App\Http\Requests;
use App\omega\models\status;
use Illuminate\Http\Request;
use App\omega\Repo\StatusRepository;

class HomeController extends Controller
{
	private $omega;
	public function __construct(StatusRepository $omega)
	{
		$this->omega = $omega;
	}

    public function index()
    {
        JavaScript::put("omegas", status::all());
        return view('welcome');
    }

    public function status()
    {
    	return status::all()->map(function($item) {
    		return $this->omega->statusOf($item->ip);
    	});
    }
}
