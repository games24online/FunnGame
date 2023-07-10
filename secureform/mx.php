<?php 
header('Access-Control-Allow-Origin: *');
$email = $_POST['email'];
$email_domain = preg_replace('/^.+?@/', '', $email).'.';
if(!checkdnsrr($email_domain, 'MX') && !checkdnsrr($email_domain, 'A')){
	echo 'false';
}
else {
	echo 'true';
}
?>