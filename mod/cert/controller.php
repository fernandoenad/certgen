<?php
class Controller{
	
	function printCertificate($data){
		global $conn;
		$result = null;
		$cer_code = mysqli_real_escape_string($conn, $data['0']['1']);
		
		$sql = "SELECT * FROM certificate 
			INNER JOIN session ON cer_ses_code=ses_code
			WHERE cer_code='$cer_code'
			ORDER BY cer_code DESC";
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
}
?>