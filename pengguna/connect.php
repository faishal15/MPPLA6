<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="apple_ijo21";
$dbname="tcari";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(!$conn){
	die("DB error");
}
?>