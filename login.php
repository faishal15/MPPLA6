<?php 
	include('conn.php');

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$myusername = mysqli_real_escape_string($conn,$_POST['uname']);
		$mypassword = mysqli_real_escape_string($conn,$_POST['psw']);

		$sql = "CALL sp_login('$myusername','$mypassword')";


		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_row($result);

		if($row[0] == '0') {
			session_start();
			if(isset($_POST['ingat'])) {
				setcookie("_username",$myusername,time()+3600);
				$ingat = $_POST['ingat'];
			}
			else {
				$ingat = 0;
			}
			$_SESSION['uname'] = $myusername;
			
			header("location: pengguna/index.php");
		}
		else if($row[0] == '-1') {
			$_SESSION['valid'] = 1;
			die(header("location: index.php"));
		}
	}

?>