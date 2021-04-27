<?php
session_start();
require_once("../../dbconfig.php");
require_once("../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "verifyCertificate"){	
		$data = array_values($_POST);
		$result = $controller->verifyCertificate($data);		
		
		header("Content-Type: application/json");
		echo json_encode($result);
		
		exit();		
	}
}

?>