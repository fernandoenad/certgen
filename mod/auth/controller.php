<?php
class Controller{
	
	function authenticateUser($data){
		global $conn;
		$result = null;
		$email = mysqli_real_escape_string($conn, $data['0']['1']);
		
		$sql = "SELECT * FROM certificate 
			WHERE cer_email='$email'";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;			
	}
}
?>