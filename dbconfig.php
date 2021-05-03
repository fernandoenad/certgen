<?php

$servername = "localhost";
if($_SERVER['HTTP_HOST'] == "localhost"){
    $username = "root";
    $password = "";
} else {
    $username = "fenad";
    $password = "fenad";  
}
$dbname = "certgen";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>