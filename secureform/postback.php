<?php
if( $curl = curl_init()) {
    if($_GET['partner'] ==  'dp') {
        $adv = 'dateprofit';
    }
    else if($_GET['partner'] ==  'bc') {
        $adv = 'braincashe';
    }
	if(mb_substr($_GET['partner'],0,2) == 'vp') {
        $adv = 'vipoffers';
    }
    else {
        $adv = 'unknown';
    }
    $clickId  = preg_replace('/[_-]/', '', $_GET['clickid']);
    $url = 'https://indextrck.com/postback/?clickid='.$clickId.'&payout=0&adv='.$adv.'&cnv_status=Donate&et=registration';
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_exec($curl);
    curl_close($curl);
}
?>
