<?php namespace App\Http\Controllers;

use App\Device;
use App\RH\Traits\Macro\MeasurementCollectionMacro;

class MonitorController extends Controller
{
    use MeasurementCollectionMacro;

    public function index()
    {
        return view("monitor.monitor");
    }

    public function getMeasurementOf(Device $device)
    {
        return collect([0 => $device])->putMeasurements()->first();
    }
}
