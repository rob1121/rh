<?php

namespace App\Http\Controllers;

use App\omega\Repo\DbTrans;

use App\Http\Requests;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param DbTrans $db
     */
    public function exportToCsv(DbTrans $db)
    {
        $db->toExcel();
    }

    public function show()
    {
        return view('device.list');
    }
}
