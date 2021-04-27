<?php
session_start();
require_once("../../dbconfig.php");
require_once("../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "loadProfile"){	
		$data = array_values($_POST);
		$result = $controller->loadProfile($data);		
		
		header("Content-Type: application/json");
		echo json_encode($result);
		
		exit();	
		
	} else if($_POST['data']['0'] == "loadCertificate"){	
		$data = array_values($_POST);
		$result = $controller->loadCertificate($data);		
		
		if($result['0']== 1){ while($row = $result['2']->fetch_assoc()){
		?>
			<tr>
			  <td><?php echo $row['cer_code'];?></td>
			  <td><?php echo $row['cer_fullname'];?></td>
			  <td><strong><?php echo $row['ses_title'];?></strong><br><?php echo $row['ses_session'];?><br><?php echo $row['ses_dates'];?></td>
			  <td><a href="" onclick="window.open('mod/cert/index.php?cer_code=<?php echo $row['cer_code'];?>', 'newwindow', 'width=1100, height=600'); return false;"><i class="fas fa-download"></i></a></td>
			</tr>
		<?php
		}}	
	}
}

?>