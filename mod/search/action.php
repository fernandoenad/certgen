<?php
session_start();
require_once("../../dbconfig.php");
require_once("../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "searchCertificate"){	
		$data = array_values($_POST);
		$result = $controller->searchCertificate($data);		
		
		$i = 1;
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<tr>
				<td>'.$i++.'</td>
				<td>'.$row['cer_fullname'].'</td>
				<td>
					'.$row['ses_title'].'<br>
					<strong>'.$row['ses_session'].'</strong>			
				</td>
				<td>';
					?>
					<a href="" onclick="window.open('mod/cert/index.php?cer_code=<?php echo $row['cer_code'];?>', 'newwindow', 'width=1100, height=600'); return false;"><i class="fas fa-download"></i></a>
					<?php 
				echo '
				</td>
			</tr>';
			
		}} else {
			echo '<tr><td colspan="4">'.$result['1'].'</tr>';
		}
	}
}

?>