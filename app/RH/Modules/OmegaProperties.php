<?php namespace App\RH\Modules;

class OmegaProperties
{
    private $content;
    private $ip;
    private $humidity;
    private $temperature;
    private $recording;
    private $status;

    public function setContent($ip)
    {
        $url = "http://" . $ip . "/postReadHtml?a";
        $this->content = file_get_contents($url);

        $this->setHumidity();
        $this->setTemperature();
        $this->setRecording();
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setHumidity()
    {
        $this->humidity = $this->measurementOf("Humidity", 5);
    }

    public function getHumidity()
    {
        return $this->humidity ? $this->humidity : "offline";
    }

    public function setTemperature()
    {
        $this->temperature =  $this->measurementOf("Temperature", 5);
    }

    public function getTemperature()
    {
        return $this->temperature ? $this->temperature : "offline";
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getRecording()
    {
        return $this->recording ? $this->recording : "OFF";
    }

    public function setRecording()
    {
        $this->recording = $this->measurementOf("Recording ", 2) === "ON" ? "ON" : "OFF";
    }

    private function measurementOf($measurement_type, $end_of_string)
    {
        $start = strpos($this->content, $measurement_type) + strlen($measurement_type);

        return trim(substr($this->content, $start, $end_of_string));
    }

    public function allData()
    {
        return [
            "humidity"           => $this->getHumidity(),
            "temperature"        => $this->getTemperature(),
            "recording"          => $this->getRecording(),
            "measurement_status" => $this->getStatus()
        ];
    }
}