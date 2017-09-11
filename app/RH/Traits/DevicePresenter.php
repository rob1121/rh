<?php namespace App\RH\Traits;


trait DevicePresenter
{
    public function getHumidityAttribute()
    {
        return $this->measurementOf("Temperature", 5);
    }

    public function getTemperatureAttribute()
    {
        return $this->measurementOf("Temperature", 5);
    }

    public function getRecordingAttribute()
    {
        return $this->measurementOf("Recording ", 2) === "ON"
            ? "ON"
            : "OFF";
    }

    public function getMeasurementStatusAttribute()
    {
        if( $this->isOffline() ) return "failed";
        return $this->isMeasurementWithinPassingLevel() ? "pass" : "failed";
    }

    private function measurementOf($measurement_type, $end_of_string)
    {
        if ( $this->deviceAvailable( $this->ip ) )
        {
            $url     = "http://{$this->ip}/postReadHtml?a";
            $content = file_get_contents($url);
            $start   = strpos($content, $measurement_type) + strlen($measurement_type);

            return substr($content, $start, $end_of_string);
        }

        return "offline";
    }

    private function deviceAvailable($ip)
    {
        $url = "http://{$ip}/postReadHtml?a";
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

    private function isMeasurementWithinPassingLevel()
    {
        return $this->temperature > 25.6 || $this->temperature < 19.5
            || $this->humidity > 55.6 || $this->humidity < 44.5;
    }

    private function isOffline()
    {
        return $this->temperature === "offline" || $this->humidity === "offline";
    }
}