<?php namespace App\RH\Modules;

use App\Configuration;

class FakeMeasurementGenerator
{
    private $config;
    private $check;

    public function __construct()
    {
        $this->config = Configuration::first();
        $this->check = new MeasurementChecker($this->config);
    }
    /**
     * @param $device
     * @return mixed
     */
    public function getFakeMeasurement($device)
    {
        return [
            'location'                  => $device['location'],
            'temperature'               => $this->generateTemperatureMeasurement($device['temperature']),
            'humidity'                  => $this->generateHumidityMeasurement($device['humidity']),
            'measurement_status'        => "pass",
            'recording'                 => "ON",
            "refreshing_time"           => (int) $device['refreshing_time'],
            "fake_reading"              => (boolean) $device['fake_reading'],
            "hide_offline"              => (boolean) $device['hide_offline'],
            "hide_pl3"                  => (boolean) $device['hide_pl3'],
        ];
    }

    /**
     * @param $temp
     * @return float
     */
    public function generateTemperatureMeasurement($temp)
    {
        return $this->check->isTemperatureWithinMinMax($temp) ? $temp : $this->generatePassingValue($this->config->temp_min, $this->config->temp_max);
    }

    /**
     * @param $rh
     * @return float
     */
    public function generateHumidityMeasurement($rh)
    {
        return $this->check->isTemperatureWithinMinMax($rh) ? $rh : $this->generatePassingValue($this->config->rh_min, $this->config->rh_max);
    }

    /**
     * @param $min
     * @param $max
     * @return float
     */
    public function generatePassingValue($min, $max)
    {
        $temp_min_max_gap = $max - $min;
        $random_percentage_multiplier = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();

        $fakeMeasurement = ($random_percentage_multiplier * $temp_min_max_gap) + $min;
        return round($fakeMeasurement, 1);
    }

}