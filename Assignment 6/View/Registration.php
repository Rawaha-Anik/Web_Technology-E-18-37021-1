<?php
	$nameErr=$name=$emailErr=$email=$username=$usernameErr=$password=$passwordErr=$confirmpassword=$confirmpasswordErr="";
	$date=$dateErr=$gender=$genderErr=$dateErr="";
	$DateBegin = date('Y-m-d',strtotime("01/01/1953"));
    $DateEnd = date('Y-m-d', strtotime("01/01/2005"));
	if(isset($_POST['Submit'])){
		$allOk = true;
		$name=$_POST["Name"];
		$email=$_POST["Email"];
		$username=$_POST["Username"];
		$password=$_POST["Password"];
		$confirmpassword=$_POST["cPassword"];
		if($_POST["Name"] === ""){
			$nameErr="Name field is empty!";
			$allOk = false;
		}
		if($_POST['Email'] === ""){
			$emailErr="Email field is empty!";
			$allOk = false;
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		}
		if($_POST['Username'] === ""){
			$usernameErr="UserName field is empty!";
			$allOk = false;
		}
		elseif(strlen($_POST['Username'])<2){
			$usernameErr="User Name must contain at least two (2) characters";
			$allOk = false;
		}
		if(strlen($_POST['Password'])==0){
			$passwordErr="Password must not be less than eight (8) characters";
			$allOk = false;
		}
		elseif(strlen($_POST['Password'])<8){
			$passwordErr="Password must not be less than eight (8) characters";
			$allOk = false;
		}
		if(strlen($_POST['cPassword'])==0){
			$confirmpasswordErr="Password must not be less than eight (8) characters";
			$allOk = false;
		}
		elseif($_POST['Password'] !== $_POST['cPassword']){
			$confirmpasswordErr="Password and Confirm Password do not match! \r\n";
			$allOk = false;
		}
		else{
			$check = false;
			for ($i=0; $i < strlen($_POST['Password']); $i++) { 
				if($_POST['Password'][$i] === '@' || $_POST['Password'][$i] === '#' || $_POST['Password'][$i] === '$' || $_POST['Password'][$i] === '%'){
					$check = true;
					break;
				}
			}
			if($check === false){
				$passwordErr="Please insert (@ or # or $ or %) special charecter in Password field \r\n";
				$allOk = false;
			}
		}
		if(empty($_POST["Gender"])){
			$allOk=false;
			$genderErr = "Gender is required";
		} 
		else{
			$gender = $_POST["Gender"];
		}
		$datefromform=$_POST['DateOfBirth'];
        if(empty($datefromform)){
			$allOk=false;
            $dateErr="Date can't be empty";
        }
        elseif($datefromform<$DateBegin || $datefromform>$DateEnd){
			$allOk=false;
            $dateErr="Invalid Date";
        }
		if($allOk === true){
			$userexist=false;
            $emailexist=false;
			include '../Controller/UserController/userControllerShow.php';
			$row1="";
			$row2="";
			$row1=ShowUserByUsernameFromController($username);
			$row2=ShowUserByEmailFromController($email);
			if(!empty($row1)){
				$userexist=true;
			}
			if(!empty($row2)){
				$userexist=true;
			}
			if($userexist==true){
                $usernameErr="Username Exists";
            }
            if($emailexist==true){
                $emailErr="Email Exists";
            }
            else{  
                if(empty($nameErr)&&empty($passwordErr)&&empty($selectErr)&&empty($confirmpasswordErr)&&empty($emailErr)&&empty($genderErr)&&empty($usernameErr)&&empty($dateErr)){  
                    $extra = array(  
                    'Name'             =>     $_POST['Name'],  
					'Username'  	  =>     $_POST["Username"],
					'Email'        	 =>     $_POST["Email"],
					'Password'      =>     $_POST["Password"],  
					'Gender'   	 =>  	   $_POST["Gender"],  
					'DateOfBirth'  =>     $_POST["DateOfBirth"]  
					);  
					addUser($extra);
					$username="";
					$name="";
					$email="";
					$datefromform="";
					$gender="";
					echo "Successful";
				}
            }
		}
	} 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
    <style>
        .Coloring{color: #ECF0F1;font-size:5vw;}
        .FontChange{color: #ECF0F1;font-size:2.5vw;}
        .field_set{border-color:#090A09;color: #080A0B;}
        .error{color: #122aa6;}
		hr{background-color: #a61224;}
    </style>
</head>
<body>
	<table border="1" width="100%" cellspacing="0">
		<tr>
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
				<br>
				<form method="POST" action="">
				<fieldset style="width: 50%" class="field_set">
					<legend> <b>REGISTRATION</b></legend>
						<table>
							<tr>
								<td> Name </td>
								<td>
								:<input type="text" name="Name" value="<?php echo $name;?>">
    							<span class="error">* <?php echo $nameErr;?></span>
    							<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> Email </td>
								<td> :<input type="email" name="Email" value="<?php echo $email;?>"> 
								<span class="error">* <?php echo $emailErr;?></span>
								<br/></td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> User Name </td>
								<td> :<input type="text" name="Username" value="<?php echo $username;?>"> 
								<span class="error">* <?php echo $usernameErr;?></span>
								<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> Password </td>
								<td> :<input type="password" name="Password"> 
								<span class="error">* <?php echo $passwordErr;?></span>
								<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> Confirm Password </td>
								<td> :<input type="password" name="cPassword"/> 
								<span class="error">* <?php echo $confirmpasswordErr;?></span>
								<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
					</table>
					<fieldset style="width: 50%" class="field_set" align="left">
   						<legend>Gender:</legend>
    					<input type="radio" name="Gender" <?php if (isset($gender) && $gender=="Female") echo "checked";?> value="Female">Female
    					<input type="radio" name="Gender" <?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">Male
    					<input type="radio" name="Gender" <?php if (isset($gender) && $gender=="Other") echo "checked";?> value="Other">Other  
    					<span class="error">* <?php echo $genderErr;?></span>
    				</fieldset>

					<fieldset style="width: 50%" class="field_set" align="left">
 				   	<legend>Date:</legend>
    				<input name="DateOfBirth" id="date" type="date" value="<?php echo $datefromform;?>">
    				<span class="error">* <?php echo $dateErr;?></span>
    				</fieldset><br>
					<hr>
					<input type="reset" name="Reset" value="Reset">
					<input type="submit" name="Submit" value="Submit">
				</fieldset>
				</form>
			<br>
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