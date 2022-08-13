<?php
    if(isset($_COOKIE['Username'])){
		session_start();
        $_SESSION['Name']=$_COOKIE["Name"];
        $_SESSION['Username'] =$_COOKIE["Username"];
        $_SESSION['Email'] =$_COOKIE["Email"];
        $_SESSION['Password'] =$_COOKIE["Password"];
        $_SESSION['Gender'] =$_COOKIE["Gender"];
        $_SESSION['DateOfBirth'] =$_COOKIE["DateOfBirth"];
		$_SESSION['BloodGroup'] =$_COOKIE["BloodGroup"];
		$_SESSION['Role'] =$_COOKIE["Role"];
		///$_SESSION['PicturePath'] =$_COOKIE["PicturePath"];
        header('Location:PublicHome.php');
    }
    else
	{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Public Home</title>
</head>
<body>
	<table border="1" width="100%" cellspacing="0">
		<tr height ="100px">
			<td align="right">
				<a href="Welcome.php"> <img src="logo.jpg" align="left"> </a> 
				<button><a href="Welcome.php"> Home </a></button> 
				&nbsp | &nbsp
				<button ><a href="login.php">Login</a></button>
				&nbsp 
			</td>
		</tr>
		<tr height = "500px">
			<td colspan="2">
				<h3> Welcome to Tiger IT </h3>
			</td>
		</tr>
		<tr height = "50px">
			<td colspan="2">
				<center> Copyright &copy 2017 </center>
			</td>
		</tr>
	</table>
</body>
</html>

<?php
	}
?>