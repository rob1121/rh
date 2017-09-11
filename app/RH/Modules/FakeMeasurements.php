<?php namespace App\RH\Modules;
class FakeMeasurements
{
    private $fake;

    /**
     * FakeMeasurements constructor.
     */
    public function __construct()
    {
        $this->fake = new FakeMeasurementGenerator();
    }

    /**
     * @param $devices
     * @return static
     */
    public function hideOfflineAndPassAllMeasurements($devices)
    {
        if(collect($devices)->count() === 1) {
            if($this->isNotOffline($devices[0])) $devices[0] = $this->fake->getFakeMeasurement($devices[0]);
            return $devices;
        }
        return $this->generateFakeReadingOnCollections($devices);
    }

    /**
     * @param $device
     * @return bool
     */
    protected function isNotOffline($device)
    {
        return $device['temperature'] !== "offline" || $device['humidity'] !== "offline";
    }

    /**
     * @param $devices
     * @return static
     */
    private function generateFakeReadingOnCollections($devices)
    {
        return collect($devices)->filter(function ($device) {
            return $this->isNotOffline($device);
        })->map(function ($device) {
            return $this->fake->getFakeMeasurement($device);
        });
    }
}