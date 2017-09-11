<?php

namespace App\Http\Controllers\Api;

use App\Configuration;
use App\Device;
use App\Http\Requests\deviceRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class deviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(["store","update","updatePosition","destroy"]);
    }

    public function index()
    {
        $user = Auth::user()?:User::whereIsAdmin(true)->first();
        $config =$user->config;
        
        return [
            "devices" => $this->transformDeviceCollection(Device::all()),
            "configuration" => $config
        ];
    }

    public function store(deviceRequest $request)
    {
        $new_device = $request->all();
        $new_device['position'] = Device::latest('id')->first()->position+1;
        return Device::create($new_device);
    }

    public function update(Device $device, deviceRequest $request)
    {
        $device->update(Device::instance($request->all()));
    }

    public function updatePositions(Request $request)
    {
        $position = 1;
        foreach($request->all() as $device) Device::whereId($device['id'])->update(["position" => $position++]);
    }

    public function destroy(Device $device)
    {
        $device->delete();
    }

    public function transformDeviceCollection($devices)
    {
        return collect($devices)->map(function($d) {
            return [
                "id"          => (int) $d->id,
                "ip"          => $d->ip,
                "location"    => $d->location,
                "position"    => (int) $d->position,
                "rh_min"    => (int) $d->rh_min,
                "rh_max"    => (int) $d->rh_max,
                "temp_min"    => (int) $d->temp_min,
                "temp_max"    => (int) $d->temp_max,
                "measurement" => [
                    "humidity"                  => "offline",
                    "temperature"               => "offline",
                    "recording"                 => "OFF",
                    "measurement_status"        => "failed",
                ]
            ];
        });

    }
}
