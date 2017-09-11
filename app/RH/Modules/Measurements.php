<?php namespace App\RH\Modules;

use App\Configuration;

class Measurements
{
    private $omega;
    private $devices;
    private $check;
    private $config;

    public function __construct($devices)
    {
        $this->config = Configuration::first();
        $this->check = new MeasurementChecker($this->config);
        $this->omega = new OmegaProperties();
        $this->devices = $devices;
    }

    public function getReadings()
    {
        return $this->check->displayFailedReadings()
            ? $this->getFakeMeasurements()
            : $this->getMeasurements();
    }

    public function getMeasurements()
    {
        return collect($this->devices)->map(function ($device) {
            if($this->check->deviceAvailability($device->ip)) $this->omega->setContent($device->ip);
            $this->omega->setIp($device->ip);
            $this->omega->setStatus($this->measurementStatus());
            $readings = collect($device)->merge($this->omega->allData());

            return $this->readingTransformerCollection($readings);
        });
    }

    public function getFakeMeasurements()
    {
        $devices = $this->getMeasurements();
        return (new FakeMeasurements())->hideOfflineAndPassAllMeasurements($devices);
    }

    private function measurementStatus()
    {
        $temperature = $this->omega->getTemperature();
        $humidity    = $this->omega->getHumidity();

        if( $this->check->isOffline($temperature) || $this->check->isOffline($humidity)  ) return "failed";

        return $this->check->isMeasurementWithinPassingLevel($temperature, $humidity) ? "pass" : "failed";
    }

    private function readingTransformerCollection($readings)
    {
        $humid = $readings['humidity'] === "offline" ? $readings['humidity'] : (float)$readings['humidity'];
        $temp = $readings['temperature'] === "offline" ? $readings['temperature'] : (float)$readings['temperature'];

        return [
            "id" => (int) $readings['id'],
            "ip"                        => $readings['ip'],
            "location"                  => $readings['location'],
            "position"                  => (int) $readings['position'],
            "humidity"                  => $humid,
            "temperature"               => $temp,
            "recording"                 => $readings['recording'],
            "measurement_status"        => $readings['measurement_status'],
            "fake_reading"              => (boolean) $this->config->fake_reading,
            "refreshing_time"           => (int) $this->config->refreshment_time_to_milli_second,
            "hide_offline"              => (boolean) $this->config->hide_offline,
            "hide_pl3"                  => (boolean) $this->config->hide_pl3,
        ];
    }

}