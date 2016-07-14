<?php namespace App\omega\Repo;

use App\omega\models\device;
use App\omega\models\status;
/**
* get content of defined url
*/
class StatusRepository {
	public $content;
    public $device;
    public $site;
	public $temp;
	public $rh;
    public $is_recording;

    /**
     * StatusRepository constructor.
     */
    public function __construct()
    {
		set_time_limit (0);
	}

    /**
     * @param $device
     * @return array
     */
    public function statusOf($device)
	{
        $this->device = $device;
        $this->site = "http://{$device->ip}/postReadHtml?a";

        return static::isSiteAvailable($this->site)
            ? $this->content()->temp()->humid()->record()->get()
            : $this->offline()->get();
	}

    /**
     * @param $url
     * @return bool
     */
    public static function isSiteAvailable($url)
    {
        //check, if a valid url is provided
        if(!filter_var($url, FILTER_VALIDATE_URL))
        {
            return false;
        }

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

    public function offline() {
        $this->temp = 'Offline';
        $this->rh = 'Offline';
        $this->is_recording = 'Off';

        return $this;
    }

    public function get()
    {

        $collection = [
            'ip' => $this->device->ip,
            'location' => $this->device->location,
            'temp' => $this->temp,
            'rh' => $this->rh,
            'is_recording' => $this->is_recording
        ];

        $isOnline = $this->temp != "Offline" || $this->rh != "Offline";
        $isRhNotPassed = $this->rh > 55.6 || $this->rh < 44.5;
        $isTempNotPassed = $this->temp > 25.6 || $this->temp < 19.5;

        if ( ( $isTempNotPassed || $isRhNotPassed ) && $isOnline )
            $this->device->status()->save(new status($collection));

    	return $collection;
    }

    /**
     * @return $this
     */
    public function record()
    {
        $getRecord = $this->getValue('Recording', 10, 2);
        $this->is_recording =  $getRecord == "Of" ? "Off" : "On";

        return $this;
    }

    /**
     * @return $this
     */
    public function humid()
    {
        $this->rh = $this->getValue('Humidity', 8, 5);

        return $this;
    }

    /**
     * @return $this
     */
    public function temp()
    {
        $this->temp = $this->getValue('Temperature', 11, 5);

    	return $this;
    }

    /**
     * @return $this
     */
    public function content()
    {
        $this->content = file_get_contents($this->site);

        return $this;
    }

    /**
     * @param $keyword
     * @param $keyword_count
     * @param $end
     * @return string
     */
    protected function getValue($keyword, $keyword_count, $end)
    {
        $start = strpos($this->content, $keyword) + $keyword_count;

        return substr($this->content, $start, $end);
    }
}