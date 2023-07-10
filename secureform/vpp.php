<?php
header('Access-Control-Allow-Origin: *');
include('./ga.php');
include('./inboxsuite.php');
include('./postback.php');
include('./registration.php');
$redirect = "https://firstrtr.com/cr.php?cid=964&ACT=69281&TRK=".$_GET['tsource'].".".$_GET['clickid']."&EX1=".$_POST['email']."&EX2=".$_POST['password']."&EX3=".$_POST['firstname']."&EX4=".$_POST['lastname']."&EX5=".$_POST['zip'];
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
