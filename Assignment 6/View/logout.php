<?php 
	session_start();
	if(isset($_SESSION['Username'])){
		unset($_SESSION['Username']);
		unset($_SESSION['Password']);
		unset($_SESSION['Email']);
		unset($_SESSION['DateOfBirth']);
		unset($_SESSION['Name']);
		unset($_SESSION['Gender']);
		setcookie("Username", "", time()-3600);
		setcookie("Name", "", time()-3600);
		setcookie("Password", "", time()-3600);
		setcookie("Email", "", time()-3600);
		setcookie("DateOfBirth", "", time()-3600);
		setcookie("Gender", "", time()-3600);
		header('location: Login.php');
	}
	else{
		echo "Please Register First";
	}
?>