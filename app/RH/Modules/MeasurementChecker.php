<?php namespace App\RH\Modules;

class MeasurementChecker
{
    public $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function displayFailedReadings()
    {
        return $this->config->fake_reading;
    }

    /**
     * @param $temperature
     * @return bool
     */
    public function isTemperatureWithinMinMax($temperature)
    {
        return $temperature < $this->config->temp_max && $temperature > $this->config->temp_min;
    }

    /**
     * @param $humidity
     * @return bool
     */
    public function isHumidityWithinMinMax($humidity)
    {
        return $humidity < $this->config->rh_max && $humidity > $this->config->rh_min;
    }

    /**
     * @param $feedback
     * @return bool
     */
    public function isOffline($feedback)
    {
        return $feedback === "offline";
    }

    /**
     * @param $temperature
     * @param $humidity
     * @return bool
     */
    public function isMeasurementWithinPassingLevel($temperature, $humidity)
    {
        return $this->isTemperatureWithinMinMax( $temperature )
        && $this->isHumidityWithinMinMax( $humidity );
    }

    /**
     * @param $ip
     * @return bool
     */
    public function deviceAvailability($ip)
    {
        $url = "http://" . $ip . "/postReadHtml?a";
        //check, if a valid url is provided
        if(!filter_var($url, FILTER_VALIDATE_URL)) return false;

        //make the connection with curl
        $cl = curl_init($url);
        curl_setopt($cl,CURLOPT_CONNECTTIMEOUT,5);
        curl_setopt($cl,CURLOPT_HEADER,true);
        curl_setopt($cl,CURLOPT_NOBODY,true);
        curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);

        //get response
        $response = curl_exec($cl);

        curl_close($cl);

        return $response ? true : false;
    }

}