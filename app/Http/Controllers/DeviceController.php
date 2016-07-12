<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\omega\Repo\ExcelRepo;
use App\omega\models\device;
use JavaScript;

class DeviceController extends Controller
{
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

    public function show()
    {
        JavaScript::put(['devices' => device::all()]);
        return view('device.list');
    }

    public function store(Request $request)
    {
        if(! device::isExist($request->ip) )
            return device::create($request->all());

        return ["error" => true];

    }

    public function delete(Device $device)
    {
        $device->delete();
    }

    public function update(device $device, Request $request)
    {
        $collection = new device($request->all());

        $device->update($collection->toArray());

    }
}
