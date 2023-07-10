<?php 
header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once(__DIR__.'/logs.php');
	//file_put_contents(__DIR__.'/logs/validate.txt', var_export(json_decode($_POST['data'], true),true));
	new Logs('validation',['clickid'=>$_POST['clickid'],'data'=>$_POST['data']]);
}
?>