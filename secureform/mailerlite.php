<?php
class Mailerlite {
    public $APIKey;
    public $GroupID;
    
	function __construct($APIKey, $GroupID, $CheckKey) {
		$this->APIKey = $APIKey;
        $this->GroupID = $GroupID;
		$this->CheckKey = $CheckKey;
		$this->MaxLimit = 10;
	}
	
	function init() {
		if($this->counter($this->MaxLimit) || $this->MaxLimit == 0) {
			$svc = __DIR__.'/logs/checker.svc';
			$email = $this->getcsv($svc);
			if(!array_search($_POST['email'], $email)) {
				$this->putcsv($email, $svc);
				$this->check();
			}
		}
	}
	
	function check() {
		$curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://app.mailercheck.com/api/v1/check/single",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"email\":\"".$_POST['email']."\"}",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json",
            "Authorization: Bearer ".$this->CheckKey
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        $status = "cURL Error #:" . $err;
        } else {
        $res = json_decode($response);
		if(isset($res->status)) {
		$status = $res->status;
		}
        }
		if(isset($status) && $status == 'valid') {
			$url = __DIR__.'/logs/checker_valid.txt';
			$this->add();
		}
		else if(isset($status) && $status != 'valid') {
			$url = __DIR__.'/logs/checker_invalid.txt';
		}
		if(isset($status)) {
			date_default_timezone_set('europe/kiev');
			$current = file_get_contents($url);
			file_put_contents($url, date("Y-m-d H:i:s").PHP_EOL.$_POST['email'].' '.$status.PHP_EOL.PHP_EOL.$current);
		}
	}
	
	function add() {
        $curl = curl_init();
        $name = isset($_GET['lpname']) ? $_GET['lpname'] : $_SERVER['SERVER_NAME'];
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.mailerlite.com/api/v2/groups/".$this->GroupID."/subscribers",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"email\":\"".$_POST['email']."\", \"name\": \"".$_POST['firstname']."\", \"fields\": {\"landing\": \"".$_POST['landing']."\",\"country\": \"".$_POST['land']."\",\"language\": \"".$_POST['language']."\"}}",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json",
            "x-mailerlite-apikey: ".$this->APIKey
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        $out = "cURL Error #:" . $err;
        } else {
        $res = json_decode($response);
		if(isset($res->fields)) {
		$field = json_decode($res->fields);
		}
        }
		
		if(isset($out)) {
			date_default_timezone_set('europe/kiev');
			$url = __DIR__.'/logs/mailerlite.txt';
			$current = file_get_contents($url);
			file_put_contents($url, date("Y-m-d H:i:s").PHP_EOL.$out.PHP_EOL.PHP_EOL.$current);
       }
	}
	
	function counter($max) {
		$CounterFile = __DIR__.'/logs/counter.dat';
		if (!file_exists ($CounterFile)) {
			$counter = 0;    
			$cf = fopen ($CounterFile, "w");
			fputs ($cf, '0');
			fclose ($cf);
		}
		else {
			$cf = fopen($CounterFile,"r");
			$counter = trim(fgets($cf));
			fclose($cf);
		}
		if(date("d", filemtime($CounterFile)) == date("d", time())) {
			$counter++;
		}
		else {
			$counter = 0;
		}
		if($counter > $max) {
			return false;
		}
		else {
			$cf = fopen ($CounterFile, "w");
			fputs($cf,$counter);
			fclose($cf);
			return true;
		}
	}
	function putcsv($email, $csv) {
		array_push($email, $_POST['email']);
		file_put_contents($csv, '');
        $fp = fopen($csv, 'w');
        fputcsv($fp, $email);
        fclose($fp);
    }
	
	function getcsv($csv) {
        $current = array();
        if (($handle = fopen($csv, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                for ($c=0; $c < $num; $c++) {
                    array_push($current, (string)$data[$c]);
                }
            }
            fclose($handle);
            return $current;
        }
    }
}


if (strtolower($_POST['language']) !== 'en') {

$APIKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiZThhODExYjViYmVlYzY1MDJkNTE3ZWEyYzFiYmU2OTllNzRiYTRiMmU0Njg2MGFmMzZjOTZjNjIyNTgxZmRiY2ZjMzQ2YmRiOWQ4N2JjODUiLCJpYXQiOjE2NjIxMDA2ODIuNDAzMjcxLCJuYmYiOjE2NjIxMDA2ODIuNDAzMjc0LCJleHAiOjQ4MTc3NzQyODIuMzk4NTExLCJzdWIiOiI5MzYzNSIsInNjb3BlcyI6W119.cVSak5Tk5hGpfwZFrL9mdLDb1d2yxzHLFSZfzdUS3s_kAFhno6aO8TYyqZRV4grZ6BZSrWAbyFOL2ImT7pbwCNV4nH11GpvPIZxvUarZ5BrdNJV4HKJSQIXJN-myFUbkteFnLoOrvXfimbV2QJ80eed_Lhdsh-lHJxK30TLCnhZQV4VfkjCHBT7ff5hHfy0ud8D8g_GGvjAD6qdXY673-SKm89FY3n_iVbG2BnVKKUEHhL1pjF9FqPLRIA0nPM1x-8oVBOhAUVMGIPc50j7OchkzCf4hntz6Nwi2V2WzuU3z3nE43vnUsFaW7NBmTL02Q3c5SxOrSfFh1gWuTsXEfgXab08d3crtLTCesZTAqEs0YowVa0sib90spLr7OLpOK1nNDEcYLwDTITL1lqt6x6DAiCmi7592wnrXCywEUiHc44hKwvsIYarQdqre4K-HafrFelRtUAhM9uygNPOejbRd32_xevuwdTUJEZDE62LHlYzV_kgoWBXDo_URgAjleFR91Ep4LPNXklBKSnDbJRhKfQjUxTVXklQsi9hovYSFOzKUZXmSg_P-l-kHSbjbIv_SsBNe0UISe3swRaaWZZCuSfunUhTW6aRlEATUydZA8xJXmagY7zDSDL_2LRVyJjuUk8Gs6fCoQ-stNd7r07npn5dTzQq9NfUmk5plibA';
$GroupID = '65117793646806304';
$CheckKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDViNGRjMzE3ODlmNGU2OWM5ZTY4MzY5NzM4NzMzNTc3MmYxOGViZTU2Nzk3YTMwMDcxMDU0ZTQxNjc5NTM0NzUwMjNhYjc3N2M1Mzk0MGQiLCJpYXQiOjE2NjIxMzAzNTQuMDc4MSwibmJmIjoxNjYyMTMwMzU0LjA3ODEwMiwiZXhwIjoxNjkzNjY2MzU0LjA2OTk1OSwic3ViIjoiMjIwNTMiLCJzY29wZXMiOltdfQ.dVG0oS_t2cDEBxSsbR-N-S2Da5x0yPH8yLit78n4a4Uj7tWTys-eQBuiJib5QiKVCljo3BTDpdM6EdEXRD01Vw';
$mailerlite = new Mailerlite($APIKey, $GroupID, $CheckKey);
$mailerlite->init();
require_once(__DIR__.'/logs.php');
new Logs('subscribe',['clickid'=>$_GET['clickid'],'email'=>$_POST['email'],'name'=>$_POST['firstname'].' '.$_POST['lastname'],'landing'=>$_POST['landing'],'country'=>$_POST['land'],'language'=>$_POST['language']]);

}
?>
