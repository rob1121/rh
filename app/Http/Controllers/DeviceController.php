<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\omega\Repo\DbTrans;
use App\omega\models\device;
use JavaScript;

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
        JavaScript::put(['devices' => device::all(['ip','location'])]);
        return view('device.list');
    }
}
