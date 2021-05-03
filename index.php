<?php 
session_start();

if(!isset($_GET['p'])){
	header("Location: ?p=auth");
} else {
	$title = ucwords($_GET['p']);
}

if(!isset($_SESSION['certgen_email'])){ $_SESSION['certgen_email'] = "0";}


include("_header.php");
include("_navbar.php");

if($_GET['p'] == "auth"){
	if(isset($_GET['logout'])){ $_SESSION['certgen_email'] = "0";}
	include("mod/auth/controller.php");
	$authCtrlr = new Controller();
	include("mod/auth/index.php");
} else if($_GET['p'] == "my"){
	include("mod/my/controller.php");
	$myCtrlr = new Controller();
	include("mod/my/index.php");
} else if($_GET['p'] == "verify"){
	include("mod/verify/controller.php");
	$verifyCtrlr = new Controller();
	include("mod/verify/index.php");
} else {
	include("_404.php");
}

include("_footer.php");
?>	

