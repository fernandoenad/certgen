<?php
class Controller{
	
	function loadProfile($data){
		global $conn;
		$result = null;
		$cer_email = mysqli_real_escape_string($conn, $data['0']['1']);
		
		$sql = "SELECT * FROM certificate 
			WHERE cer_email='$cer_email'
			ORDER BY cer_code DESC
			LIMIT 1";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}
		
		return $result;			
	}
	
	
	function loadCertificate($data){
		global $conn;
		$result = null;
		$cer_email = mysqli_real_escape_string($conn, $data['0']['1']);
		
		$sql = "SELECT * FROM certificate 
			INNER JOIN session ON cer_ses_code=ses_code
			WHERE cer_email='$cer_email'
			ORDER BY cer_code DESC";
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