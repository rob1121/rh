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
	public $temp = "Offline";
	public $rh = "Offline";

	public function __construct() {
		set_time_limit (0);
	}

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
        if( Static::isSiteAvailable($this->site) )
        	$this->content = file_get_contents($this->site);

        return $this;
    }

    public function temp()
    {
		if(  Static::isSiteAvailable($this->site) )
			$this->temp = substr($this->content, strpos($this->content, 'Temperature') + 11, 5);

    	return $this;
    }

    public function humid()
    {
    	if(  Static::isSiteAvailable($this->site) )
    		$this->rh = substr($this->content, strpos($this->content, 'Humidity') + 8, 5);

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
}