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
            include '../Controller/AdminController/ControllerShowAdminInformation.php';
            $data=ControllerShowAllAdmins();
            foreach($data as $row){ 
                if($row["Username"]==$_POST["Username"] && $row["Password"]==$_POST["Password"]){
                    $userexist=true;
                    $passwordexist=true;;                    
				}
            }
			if($userexist==true&&$passwordexist==true){
				$Username=$_POST["Username"];
				$detailsarrays=ControllerShowAdminByUsername($Username);
				session_start();
				setcookie('Username',$detailsarrays["Username"],time()+1000);
				setcookie('Name',$detailsarrays["Name"],time()+1000);
				setcookie('Email',$detailsarrays["Email"],time()+1000);
				setcookie('Password',$detailsarrays["Password"],time()+1000);
				setcookie('Gender',$detailsarrays["Gender"],time()+1000);
				setcookie('DateOfBirth',$detailsarrays["DateOfBirth"],time()+1000);
				setcookie('Role',$detailsarrays["Role"],time()+1000);
				setcookie('BloodGroup',$detailsarrays["BloodGroup"],time()+1000);
				///setcookie('PicturePath',$detailsarrays["PicturePath"],time()+1000);
				$_SESSION['Name']=$detailsarrays["Name"];
				$_SESSION['Username']=$detailsarrays["Username"];
				$_SESSION['Email']=$detailsarrays["Email"];
				$_SESSION['Password']=$detailsarrays["Password"];
				$_SESSION['Gender']=$detailsarrays["Gender"];
				$_SESSION['DateOfBirth']=$detailsarrays["DateOfBirth"];
				$_SESSION['Role']=$detailsarrays["Role"];
				$_SESSION['BloodGroup']=$detailsarrays["BloodGroup"];
				///$_SESSION['PicturePath']=$detailsarrays["PicturePath"];
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
	<script>
		function validateForm(){
			let k=true;
			let x;
			x = document.forms["myForm"]["Username"].value;
			if(x==""){
				document.getElementById("Username").style.borderColor="red";
				document.getElementById("usernamespan").innerHTML="Username Can't Be Empty";
				k&=false;
			}
			else if(x.length<2){
				document.getElementById("Username").style.borderColor="red";
				document.getElementById("usernamespan").innerHTML="Username Must Be Of Atleast 2 Characters";
				k&=false;
			}
			else{
				document.getElementById("Username").style.borderColor="black";
				document.getElementById("usernamespan").innerHTML="";
				k&=true;
			}
			x = document.forms["myForm"]["Password"].value;
			if(x==""){
				document.getElementById("Password").style.borderColor="red";
				document.getElementById("passwordspan").innerHTML="Password Can't Be Empty";
				k&=false;
			}
			else{
				document.getElementById("Password").style.borderColor="black";
				document.getElementById("passwordspan").innerHTML="";
				k&=true;
			}
			if(k==1)return true;
			return false;
		}
	</script>
</head>
<body>
	<table border="1" width="100%" cellspacing="0">
		<tr height ="200px">
			<td align="right">
				<a href="Welcome.php"> <img src="logo.jpg" align="left"> </a> 
				<button><a href="Welcome.php"> Home </a></button> 
				&nbsp | &nbsp
				<button ><a href="login.php">Login</a></button>
				&nbsp 
			</td>
		</tr>
		<tr height = "500px">
			<td colspan="2" align="center">
				<form method="POST" action="" onsubmit= "return validateForm()" name="myForm">
					<fieldset style="width: 45%">
						<legend> <b>Login</b></legend>
							<table>
							<tr>
								<td>UserName: </td>
								<td> <input type="text" name="Username" id="Username"/>
								<span class="error" id="usernamespan"><?php echo $usernameErr;?></span> 
								<br/> </td>
							</tr>
							<tr>
								<td> Password: </td>
								<td> <input type="password" name="Password" id="Password"/>
								<span class="error" id="passwordspan"><?php echo $passwordErr;?></span>
								<br/></td>
							</tr>
						</table>
						<hr>
						<br>
						<input type="submit" name="Submit" id="Submit" value="Submit"> 
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