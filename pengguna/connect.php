<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="tcari";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(!$conn){
	die("DB error");
}
?>