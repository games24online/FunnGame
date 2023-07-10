<?php
if( $curl1 = curl_init()) {
	if(isset($_GET['afseid']) && strlen($_GET['afseid']) > 0) {
		$url1 = 'https://offers-adverster.affise.com/postback?clickid='.$_GET['afseid'].'&sum=0&status=2&goal=2';
		curl_setopt($curl1, CURLOPT_URL, $url1);
		curl_setopt($curl1, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl1, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($curl1);
		curl_close($curl1);
	}
}
$trc = isset($_GET['trc'])?$_GET['trc']:0;
if( $curl2 = curl_init() && ( $trc == 1 || strlen($_GET['clickid']) == 24)) {
	if(isset($_GET['clickid']) && strlen($_GET['clickid']) > 0) {
		$url2 = "https://track.theagencyone.com/postback";
		$curl2 = curl_init($url2);
		curl_setopt($curl2, CURLOPT_URL, $url2);
		curl_setopt($curl2, CURLOPT_POST, true);
		curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
		$headers = array(
			"Content-Type: application/x-www-form-urlencoded",
		);
		curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);
		$data = "cid=".$_GET['clickid']."&payout=0&et=registration";
		curl_setopt($curl2, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl2, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);
		$resp = curl_exec($curl2);
		curl_close($curl2);
	}
}
require_once(__DIR__.'/logs.php');
new Logs('registration',['clickid'=>$_GET['clickid'], 'email'=>$_POST['email'],'password'=>$_POST['password'],'firstname'=>$_POST['firstname'],'lastname'=>$_POST['lastname'],'zip'=>$_POST['zip'],'country'=>$_POST['country']]);
?>
