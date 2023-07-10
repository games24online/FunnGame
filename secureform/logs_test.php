<?php
class Logs {	
	private $key = '4AdkcDsDCjfZXFweRYx1';
    public function __construct($type, $fields){
		$this->send($type, $fields);
    }
	private function send($type, $fields) {
		//$url = 'http://146.190.236.176/api/';
		$url = 'http://146.190.236.175/api/';
		$headers = [
			'key: ' . $this->key,
			'ip: ' . $_SERVER['SERVER_ADDR'],
			'type: ' . $type
		];
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HEADER, true);
		if(strpos(get_headers($url)[0], '404') == false) {
			$response = curl_exec($curl);
		}
		curl_close($curl);
		//file_put_contents(__DIR__.'/logs/test.txt', var_export($fields,true));
	}
}
?>
