<?php
namespace Curl;
/**
 * @author	Jason Michels
 * @link	https://thebizztech@github.com/thebizztech/Simple-Codeigniter-Curl-PHP-Class.git
 */

class Curl {
	
	private $url = "";
	private $headers = array(); //Headers are built in set_headers() and passed in execute()
	private $post_data = "";
	private $fields_string = "";
	
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}

	public function buildPostString()
	{
		$this->fields_string = null;
		foreach($this->post_data as $key=>$value) { $this->fields_string .= $key.'='.$value.'&'; }
		$this->fields_string = rtrim($this->fields_string,"&");
		return $this;
	}
	
	//Headers can be modified depending on what you need cURL to accomplish
	private function setHeaders($type = '')
	{
		$this->headers = array(
						CURLOPT_URL => $this->url,
						CURLOPT_VERBOSE => 1,
						CURLOPT_SSL_VERIFYPEER => FALSE,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_RETURNTRANSFER => TRUE
		);

		if($type == 'post')
		{
			$this->headers[CURLOPT_POST] = TRUE;
			$this->buildPostString();
			$this->headers[CURLOPT_POSTFIELDS] = $this->fields_string;
		}
		return $this;
	}

	//Set the headers and process curl via a GET
    public function get()
    {
		return $this->setHeaders()->execute();
    }
	
	//Set the headers and process curl via a POST
	public function post($data)
    {
    	$this->post_data = $data;
		return $this->setHeaders('post')->execute();
    }
	
	//Starts curl and sets headers and returns the data in a string
	private function execute()
	{
		$ch = curl_init();
		
		curl_setopt_array($ch, $this->headers);
		// grab URL
		$result = curl_exec($ch);

		curl_close($ch);
		return $result;
	}
}

/* End of file Curl.php */