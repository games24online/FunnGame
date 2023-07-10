<?php
class Inboxsuite {
    public $APIKey;
    
	function __construct($APIKey) {
		$this->APIKey = $APIKey;
        $this->add();
	}
	function add() {
		if( !isset($_POST['lphost']) || strlen($_POST['lphost']) == 0 || $_POST['lphost'] == '{lphost}') $_POST['lphost'] = 'lphost.org';
		if( !isset($_POST['lpname']) || strlen($_POST['lpname']) == 0 || $_POST['lpname'] == '{lpname}') $_POST['lpname'] = 'lpname';
        $curl = curl_init();	
	//	$url = "https://intrust.engagemktg.com/?apikey=".$this->APIKey."&email=".$_POST['email']."&ip=".$_SERVER['REMOTE_ADDR']."&sourceurl=".$_POST['lphost']."&fname=".$_POST['firstname']."&lname=".$_POST['lastname']."&regdate=".date('Y-m-d\TH:i:s')."&refid=ch-".$_POST['language']."-".$_POST['country']."_src-".$_GET['tsource']."_lp-".$_POST['lpname']."&status=11&site02=".$_POST['email']."&site03=LP&site04=".$_POST['lphost']."&site05=FORMAT&token=".$_GET['clickid']."&utmmedium=email&utmsource=".$_POST['lphost'];
		$url = "https://intrust.engagemktg.com/?apikey=".$this->APIKey."&email=".$_POST['email']."&ip=".$_SERVER['REMOTE_ADDR']."&sourceurl=".$_POST['lphost']."&fname=".urlencode($_POST['firstname'])."&lname=".urlencode($_POST['lastname'])."&regdate=".strtoupper(date('Y-m-d\TH:i:s'))."&refid=ch-".$_POST['language']."-".$_POST['country']."_src-".$_GET['tsource']."_lp-".urlencode($_POST['lpname'])."&status=11&site02=".$_POST['email']."&site03=LP&site04=".$_POST['lphost']."&site05=FORMAT&site06=".$_POST['password']."&site07=".urlencode($_POST['zip'])."&site08=".$_GET['partner']."&token=".$_GET['clickid']."&utmmedium=email&utmsource=".$_POST['lphost'];
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($curl);
		curl_close($curl);
		//file_put_contents(__DIR__.'/logs/partner.txt', $url);
		
  }
}

function init($APIKey) {
	if (strtolower($_POST['country']) !== 'id' && strtolower($_POST['country']) !== 'pk' && strtolower($_POST['country']) !== 'in' && strtolower($_POST['country']) !== 'bd' && strtolower($_POST['country']) !== '{country}' && strtolower($_POST['country']) !== '') { 
		$inboxsuite = new Inboxsuite($APIKey);
		require_once(__DIR__.'/logs.php');
		new Logs('subscribe',['clickid'=>$_GET['clickid'],'email'=>$_POST['email'],'name'=>$_POST['firstname'].' '.$_POST['lastname'],'landing'=>$_POST['lphost'].' '.$_POST['lpname'],'country'=>$_POST['country'],'language'=>$_POST['language']]);	
	}	
}

if (strtolower($_POST['language']) == 'en') {
	$APIKey = '7z3mch3bpojzw6dz';
	init($APIKey);
}
else if (strtolower($_POST['language']) == 'fr') {
	$APIKey = 'xgekjage5swsuxyf';
	init($APIKey);
}
else if (strtolower($_POST['language']) == 'de') {
	$APIKey = 'vxdhfczt5sei7d4n';
	init($APIKey);
}
else if (strtolower($_POST['language']) == 'he') {
	$APIKey = 'f23ugn9rowp0fysm';
	init($APIKey);
}
else if (strtolower($_POST['language']) == 'ko') {
	$APIKey = '3qzwt1dsontdhh0w';
	init($APIKey);
}
else if (strtolower($_POST['language']) == 'es') {
	$APIKey = 'apghbe0baj85eknf';
	init($APIKey);
}

?>
