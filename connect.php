<?php
$servername ="localhost";
$username = "root";
$password = "apple_ijo21";
$database = "tcari";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn) {
	echo "failed";
	die("Connection failed: " . mysqli_connect_error());	
}
else {
	//echo "success";
}

?>