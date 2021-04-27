<?php require("dbconfig.php");?>
<?php require("settings.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title><?php echo $webapp_nameshort;?> | <?php echo $title;?></title>
	<meta name="description" content="<?php echo "The official $app_desc portal of $org_fullname - $org_citymun, $org_province";?>">
    <meta name="author" content="<?php echo $app_author;?>">
	<meta name="keywords" content="<?php echo "$webapp_namefull, $webapp_nameshort";?>">
	<link rel="icon" href="assets/images/logo.png" type="image/x-icon">

	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="assets/style.css">
	<link rel="stylesheet" href="assets/font.css">
