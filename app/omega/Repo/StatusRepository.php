<?php namespace App\omega\Repo;

use App\omega\models\status;

/**
* get content of defined url
*/
class StatusRepository
{
	public $content;
	public $url;
    public $site;
	public $temp;
	public $rh;

	public function statusOf($url)
	{
		$this->url = $url;
        $this->site = "http://{$url}/postReadHtml?a";

		return $this->content()
            ->temp()
            ->humid()
            ->get();
	}

    public function content()
    {
        $this->content = Static::isDeviceRunning($this->site)
            ? file_get_contents($this->site)
            : '';

        return $this;
    }

    public function temp()
    {
		$this->temp = '' == $this->content
			? 'Offline'
			: substr($this->content, strpos($this->content, 'Temperature') + 11, 5) . " &deg;C";

    	return $this;
    }

    public function humid()
    {
    	$this->rh = '' == $this->content
    		? 'Offline'
    		: substr($this->content, strpos($this->content, 'Humidity') + 8, 5) . " %";

    	return $this;
    }
    public function get() {

    	return [
            'ip' => $this->url,
            'location' => status::location($this->url),
            'temp' => $this->temp,
            'rh' => $this->rh
        ];
    }

    public static function isDeviceRunning($site)
    {
        $socket =@ fsockopen($site, 80, $errno, $errstr, 30);

        if ($socket) fclose($socket);

        return $socket;
    }
}