<?php
	session_start();
	if(isset($_COOKIE['Username']))
	{
        $_SESSION['Name']=$_COOKIE["Name"];
        $_SESSION['Username'] =$_COOKIE["Username"];
        $_SESSION['Email'] =$_COOKIE["Email"];
        $_SESSION['Password'] =$_COOKIE["Password"];
        $_SESSION['Gender'] =$_COOKIE["Gender"];
        $_SESSION['DateOfBirth'] =$_COOKIE["DateOfBirth"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
    <style>
        .Coloring{}
        .FontChange{}
        .SecondaryFont{}
        .field_set{}
        .error {}
    </style>
</head>
<body>
    <?php
     $nameErr = $emailErr = $genderErr = $usernameErr = $passwordErr=$confirmpasswordErr=$dateErr="";
     $name = $email = $gender = $comment = $website = $username=$password=$confirmpassword=$errorJSON=$message="";
     $DateBegin = date('Y-m-d',strtotime("01/01/1953"));
     $DateEnd = date('Y-m-d', strtotime("01/01/2005"));
     if($_SERVER["REQUEST_METHOD"]=="POST"){
            $matched=false;
            if($_SESSION['Password']==$_POST["Current_Password"]){
                if($_POST["New_Password"]==$_POST["Confirm_Password"]){
                    $matched=true;
                }       
            }
            if($matched==false){
                $passwordErr="* Password didn't match";
            }
            else{  
                if(empty($nameErr)&&empty($passwordErr)&&empty($confirmpasswordErr)&&empty($emailErr)&&empty($genderErr)&&empty($usernameErr)&&empty($dateErr)){  
                    include '../Controller/UserController/userControllerUpdateUser.php';
                    $extra = array(
                        'Name'             =>     $_SESSION['Name'],  
                        'Email'         =>     $_SESSION["Email"],
                        'Password'      =>     $_POST["New_Password"],  
                        'Username'    =>     $_SESSION["Username"],
                        'Gender'    =>     $_SESSION["Gender"],  
                        'DateOfBirth'     =>  $_SESSION["DateOfBirth"], 
                    );
                    UpdateUserFromController($_SESSION["Username"],$extra);
                    $_SESSION['Password']=$_POST["New_Password"];
                    setcookie('Password',$_POST["New_Password"],time()+1000);
                }
            }
        }  
        else{  
            $errorJSON='JSON File not exits';  
        }
    ?>
	<table border="1" width="100%" cellspacing="0">
		<tr>
			<td align="right" colspan="3">
				<?php
                    include 'Login As.php'; 
                ?>
			</td>
		</tr>
		<tr height = "200px">
			<td width="33%">
				<?php
                    include 'sideoptions.php';
                ?>
			</td>
			<td colspan="2" align="left" class="SecondaryFont">
				<br>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<fieldset style="width: 70%">
                        <legend><p colour="#080A0B"<b>Change Password</b></p></legend>
						<table>
							<tr>
								<td colspan="2"> Name: <?php echo $_SESSION['Name'];?></td> 
								<br>
							</tr>
							<tr><td colspan="2"><hr></td></tr>
							<tr>
								<td>Current Password</td>
								<td> : &nbsp <input type="password" name="Current_Password" size="35%"> 
                                <span class="SecondaryFont"><?php echo $passwordErr;?></span>
								<br/></td>
							</tr>
                            <tr>
								<td>New Password </td>
								<td> : &nbsp <input type="password" name="New_Password" size="35%"> 
								<br/></td>
							</tr>
                            <tr>
								<td>Confirm Password </td>
								<td> : &nbsp <input type="password" name="Confirm_Password" size="35%"> 
								<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
					    </table>
					<hr>
					<input type="submit" name="Submit" value="Submit">
				</fieldset>
				</form>
				<br> 
			</td>
		</tr>
		<tr height = "50px">
			<td colspan="3">
				<center> Copyright &copy 2017 </center>
			</td>
		</tr>
	</table>
</body>
</html>
    <?php
     echo $message;
    ?>
<?php
	}
    else{
		echo "Please do Registration before login in";
	}
?>