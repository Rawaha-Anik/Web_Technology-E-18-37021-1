<?php
    if(isset($_COOKIE['Username'])){
		session_start();
        $_SESSION['Name']=$_COOKIE["Name"];
        $_SESSION['Uname'] =$_COOKIE["Username"];
        $_SESSION['Email'] =$_COOKIE["Email"];
        $_SESSION['Password'] =$_COOKIE["Password"];
        $_SESSION['Gender'] =$_COOKIE["Gender"];
        $_SESSION['DateOfBirth'] =$_COOKIE["DateOfBirth"];
        header('Location:PublicHome.php');
    }
    else{
?>
<?php
    $usernameErr=$passwordErr=$username="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["Username"]) || empty($_POST["Password"])) {
            if(empty($_POST["Username"]))$usernameErr = "* Username Is Required";
            if(empty($_POST["Password"]))$passwordErr = "* Password is required";
        }
        else{
			$userexist=false;
			$passwordexist=false;
            include '../Controller/UserController/userControllerShow.php';
            $data=ShowAllUsersFromController();
            foreach($data as $row){ 
                if($row["Username"]==$_POST["Username"] && $row["Password"]==$_POST["Password"]){
                    $userexist=true;
                    $passwordexist=true;;                    
				}
            }
			if($userexist==true&&$passwordexist==true){
				$username=$_POST["Username"];
				$detailsarrays=ShowUserByUsernameFromController($username);
				session_start();
				setcookie('Username',$detailsarrays["Username"],time()+1000);
				setcookie('Name',$detailsarrays["Name"],time()+1000);
				setcookie('Email',$detailsarrays["Email"],time()+1000);
				setcookie('Password',$detailsarrays["Password"],time()+1000);
				setcookie('Gender',$detailsarrays["Gender"],time()+1000);
				setcookie('DateOfBirth',$detailsarrays["DateOfBirth"],time()+1000);
				$_SESSION['Name']=$detailsarrays["Name"];
				$_SESSION['Username'] =$detailsarrays["Username"];
				$_SESSION['Email'] =$detailsarrays["Email"];
				$_SESSION['Password'] =$detailsarrays["Password"];
				$_SESSION['Gender'] =$detailsarrays["Gender"];
				$_SESSION['DateOfBirth'] =$detailsarrays["DateOfBirth"];
				header("location:PublicHome.php");
			}
			else{
				$usernameErr="Invalid Username Or Password";
			}        
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Public Home</title>
	<style>
		.error{color: #122aa6;}
	</style>
</head>
<body>
	<table border="1" width="100%" cellspacing="0">
		<tr height ="200px">
			<td align="right">
				<a href="Welcome.php"> <img src="logo.jpg" align="left"> </a>
				<a href="Welcome.php"> Home </a> 
				&nbsp | &nbsp
				<a href="Login.php"> Login </a>
				&nbsp | &nbsp
				<a href="Registration.php"> Registration </a>
				&nbsp
			</td>
		</tr>
		<tr height = "500px">
			<td colspan="2" align="center">
				<form method="POST" action="">
					<fieldset style="width: 50%">
						<legend> <b>Login</b></legend>
							<table>
							<tr>
								<td>UserName: </td>
								<td> <input type="text" name="Username"/>
								<span class="error"><?php echo $usernameErr;?></span> 
								<br/> </td>
							</tr>
							<tr>
								<td> Password: </td>
								<td> <input type="password" name="Password"/>
								<span class="error"><?php echo $passwordErr;?></span>
								<br/></td>
							</tr>
						</table>
						<hr>
						<br>
						<input type="submit" name="Submit" value="Submit"> 
					</fieldset>
				</form>
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