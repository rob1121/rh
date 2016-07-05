<?php namespace App\omega\Repo;

/**
* get content of defined url
*/
class StatusRepository
{
	public $content;
	public $url;
	public $temp;
	public $rh;

	public function statusOf($url)
	{
		$this->url = $url;


		if($socket =@ fsockopen($this->url, 80, $errno, $errstr, 30)) {
			return  'online!';
		} else {
			return  'offline.';
		}

		return $this->content()->temp()->humid()->get();
	}

    public function content()
    {
    	$this->content = file_get_contents("http://{$this->url}/postReadHtml?a", true);

    	if ($this->content === false)  return [$this->url => ['temp' => 'No Response', 'rh' => 'No Response']];

    	return $this;
    }

    public function temp()
    {
		$this->temp = '' == $this->content
			? 'No Response'
			: substr($this->content, strpos($this->content, 'Temperature') + 11, 5) . " &deg;C";

    	return $this;
    }

    public function humid()
    {
    	$this->rh = '' == $this->content
    		? 'No Response'
    		: substr($this->content, strpos($this->content, 'Humidity') + 8, 5) . " %";

    	return $this;
    }

    public function get() {
    	return [$this->url => ['temp' => $this->temp, 'rh' => $this->rh]];
    }
}