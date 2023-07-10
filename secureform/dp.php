<?php
header('Access-Control-Allow-Origin: *');
include('./ga.php');
include('./inboxsuite.php');
include('./postback.php');
include('./registration.php');
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$acceptLang = ['es', 'ja', 'fr', 'de', 'en', 'ko']; 
$lang = in_array($lang, $acceptLang) ? $lang : 'en';
if(isset($_GET['debug']) && isset($_GET['print']) && isset($_GET['lang'])) {
	$lang = $_GET['lang'];
}
$payment = [
        "es" => "https://naughtyfreegames.com/tours/41/z/?wid=8862&k1=".$_GET['tsource']."&k2=".$_GET['p4']."&ps=s&email=".$_POST['email']."&zip=".$_POST['zip']."&username=".$_POST['firstname']."&password=".$_POST['password']."&uid=".$_GET['clickid'],
        "ja" => "https://naughtyfreegames.com/tours/42/z/?wid=8862&k1=".$_GET['tsource']."&k2=".$_GET['p4']."&ps=s&email=".$_POST['email']."&zip=".$_POST['zip']."&username=".$_POST['firstname']."&password=".$_POST['password']."&uid=".$_GET['clickid'],
        "fr" => "https://www.naughtyfreegames.com/tours/39/z/?wid=8862&k1=".$_GET['tsource']."&k2=".$_GET['p4']."&ps=s&email=".$_POST['email']."&zip=".$_POST['zip']."&username=".$_POST['firstname']."&password=".$_POST['password']."&uid=".$_GET['clickid'],
        "de" => "https://naughtyfreegames.com/tours/40/z/?wid=8862&k1=".$_GET['tsource']."&k2=".$_GET['p4']."&ps=s&email=".$_POST['email']."&zip=".$_POST['zip']."&username=".$_POST['firstname']."&password=".$_POST['password']."&uid=".$_GET['clickid'],
        "en" => "https://securegamesite.com/frame/z/?wid=8862&k1=".$_GET['tsource']."&k2=".$_GET['p4']."&email=".$_POST['email']."&username=".$_POST['firstname']."&password=".$_POST['password']."&zip=".$_POST['zip']."&uid=".$_GET['clickid'],
		"ko" => "https://www.securelyjoin.com/frame/z3/?wid=8862&k1=".$_GET['tsource']."&k2=".$_GET['p4']."&email=".$_POST['email']."&username=".$_POST['firstname']."&password=".$_POST['password']."&zip=".$_POST['zip']."&uid=".$_GET['clickid']
];
$redirect = $payment[$lang]; 
if(isset($_GET['debug']) && isset($_GET['print'])) {
	var_dump($_POST);
	echo '<br/><br/>';
	echo $redirect;
}
else if(isset($_GET['getlink'])) {
	echo $redirect;
} else {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$redirect);
}
exit(); 
?>
