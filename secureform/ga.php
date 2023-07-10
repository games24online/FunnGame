<?php 
function gaParseCookie() {
  return isset($_GET['uid'])?$_GET['uid']:gaGenUUID();
}
function gaGenUUID() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}
function getKey($stream) {
	$ga4params = [
		'G-34FH338B4E' => 'vX4aW_jCQGaxrPVzpEIb9g',
		'G-JHMKBE25GQ' => 'KaNI3C1ITHCf6rFD1tibeQ'
	];
	return $ga4params[$stream];
}
function ga() {
    if( $curl = curl_init()) {
		$data = array(
			'client_id' => gaParseCookie(),
			'user_id' => gaParseCookie(),
				'events' => array(
				'name' => 'registration',
				'params' => array(
					'uid' => gaParseCookie()
					)
				)
		);
		curl_setopt($curl, CURLOPT_URL, 'https://www.google-analytics.com/mp/collect?measurement_id='.$_GET['stream'].'&api_secret='.getKey($_GET['stream']));
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($curl,CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$result = curl_exec($curl);
		curl_close($curl);
	}
}
	ga();
?>