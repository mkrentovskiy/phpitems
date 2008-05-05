<?
	// error_reporting(E_ALL);

	include "config.php";
	include "usecases.php";
	
	$session = new Session();
	$db = new Database;

	$db->connect($db_host, $db_user, $db_password, $db_name);

	if($DEBUG) {
		print "<pre>";
		print_r($_GET);
		print_r($_POST);
		print_r($_SESSION);
		print "</pre>";		
	}
	
	$uc = strlen($_GET['usecase']) > 0 ? 
		$_GET['usecase'] : 
		( strlen($_POST['usecase']) > 0 ? $_POST['usecase'] : "Start");

	if(!@ereg("([a-zA-Z]*)",$uc) || strlen($uc) == 0) 
		$uc = 'Start';

	if(class_exists('UC'.$uc)) { 
		@eval('$obj = new UC'.$uc.';');
		$obj->execute();
	};

	$db->disconnect();
?>