<?php
//$allow = array('US', 'CA', 'GB', 'IE', 'AU', 'NZ');
//$country = str_replace('_', '', strtoupper($_GET['autocamp']));
//if (in_array($country, $allow)) {

class Inboxsuite {
    public $APIKey;
    
	function __construct($APIKey) {
		$this->APIKey = $APIKey;
        $this->add();
	}
	function add() {	
	
        $curl = curl_init();
		//$url = "https://intrust.inboxsuite.com/v2?apikey=".$this->APIKey."&email=".$_POST['email']."&ip=".$_SERVER['REMOTE_ADDR']."&sourceurl=".$_POST['lphost']."&amp;regdate=".date('Y-m-d\TH:i:s')."&refid=ch-".$_POST['language']."-".$_POST['land']."_src-".$_GET['tsource']."_lp-".$_POST['lpname']."&status=11";
		$url = "https://intrust.engagemktg.com/?apikey=".$this->APIKey."&email=".$_POST['email']."&ip=".$_SERVER['REMOTE_ADDR']."&sourceurl=".$_POST['lphost']."&fname=".$_POST['firstname']."&lname=".$_POST['lastname']."&regdate=".date('Y-m-d\TH:i:s')."&refid=ch-".$_POST['language']."-".$_POST['land']."_src-".$_GET['tsource']."_lp-".$_POST['lpname']."&status=11&site02=".$_POST['email']."&site03=LP&site04=".$_POST['lphost']."&site05=FORMAT&site06=".$_POST['password']."&site07=".$_POST['zip']."&token=".$_GET['clickid']."&utmmedium=email&utmsource=".$_POST['lphost'];
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$responce =  json_decode(curl_exec($curl));
		curl_close($curl);
		
	//	if($responce->code != 0) {
			date_default_timezone_set('europe/kiev');
			$log = realpath($_SERVER['DOCUMENT_ROOT']).'/logs/inboxsuite_test.txt';
			$current = file_get_contents($log);
			$error = date("Y-m-d H:i:s").PHP_EOL;
			$error .= 'responce code: '.$responce->code.PHP_EOL;
			$error .= 'responce message: '.$responce->msg.PHP_EOL;
			$error .= 'email: '.$_POST['email'].PHP_EOL;
			$error .= 'ip: '.$_SERVER['REMOTE_ADDR'].PHP_EOL;
			$error .= 'sourceurl: '.$_POST['lphost'].PHP_EOL;
			$error .= 'regdate: '.date('Y-m-d\TH:i:s').PHP_EOL;
			$error .= 'refid: '."ch-".$_POST['language']."-".$_POST['land']."_src-".$_GET['tsource']."_lp-".$_POST['lpname'].PHP_EOL;
			$error .= 'url: '.$url.PHP_EOL;
			$error .= PHP_EOL;
			file_put_contents($log, $error.$current);
	//	}

  }
}

$APIKey = 'f23ugn9rowp0fysm';
$inboxsuite = new Inboxsuite($APIKey);

//require_once(__DIR__.'/logs.php');
//new Logs('inboxs',['clickid'=>$_GET['clickid'],'email'=>$_POST['email'],'name'=>$_POST['firstname'].' '.$_POST['lastname'],'landing'=>$_POST['landing'],'country'=>$_POST['land'],'language'=>$_POST['language']]);

//}
?>
