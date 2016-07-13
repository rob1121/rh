<?php

namespace App\Http\Controllers;

use App\omega\Repo\DbTrans;
use Illuminate\Http\Request;
use App\omega\Repo\ExcelRepo;
use App\omega\models\device;
use JavaScript;

class DeviceController extends Controller
{
    /**
     * DeviceController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param ExcelRepo $db
     */
    public function exportToCsv(ExcelRepo $db)
    {
        $db->toExcel();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        JavaScript::put(['devices' => device::all()]);
        return view('device.list');
    }

    /**
     * @param DbTrans $db
     * @return static
     */
    public function store(DbTrans $db)
    {
        return $db->validateRequest()->store();
    }

    /**
     * @param device $device
     * @throws \Exception
     */
    public function delete(device $device)
    {
        $device->delete();
    }

    /**
     * @param device $device
     * @param Request $request
     */
    public function update(device $device, Request $request)
    {
        $collection = new device($request->all());

        $device->update($collection->toArray());

    }
}
