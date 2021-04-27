<?php
session_start();
require_once("../../dbconfig.php");
require_once("../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "authenticateUser"){	
		$data = array_values($_POST);
		$result = $controller->authenticateUser($data);		
		
		if($result['0'] == 1){
			$_SESSION['certgen_email'] = $data['0']['1'];
		} else {
			$_SESSION['certgen_email'] = "0";
		}
		
		header("Content-Type: application/json");
		echo json_encode($result);
		
		exit();		
	}
}

?>