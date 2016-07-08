<?php

namespace App\Http\Controllers;

use JavaScript;
use App\Http\Requests;
use App\omega\models\status;
use App\omega\Repo\StatusRepository;
use App\omega\Repo\DbTrans;

class HomeController extends Controller
{
    public function index()
    {
        JavaScript::put(["omegas" => status::all()]);
        return view('welcome');
    }

    public function status(StatusRepository $omega)
    {
    	return status::all()->map(function($item) use($omega){
    		return $omega->statusOf($item->ip);
    	});
    }

    public function exportToCsv(DbTrans $db)
    {
        $db->toExcel();
    }
}
