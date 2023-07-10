<?php 
header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once(__DIR__.'/logs.php');
	//file_put_contents(__DIR__.'/logs/test.txt', $_POST['resolve']);
	new Logs('proposition',['clickid'=>$_POST['clickid'],'resolve'=>$_POST['resolve']]);
}
?>