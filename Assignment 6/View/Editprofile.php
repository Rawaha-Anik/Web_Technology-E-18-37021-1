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
<?php
    include '../Controller/UserController/userControllerUpdateUser.php';
    $nameErr = $emailErr = $genderErr = $usernameErr = $passwordErr=$confirmpasswordErr=$dateErr="";
    $name = $email = $gender = $comment = $website = $username=$password=$confirmpassword=$errorJSON=$message="";
    $DateBegin = date('Y-m-d',strtotime("01/01/1953"));
    $DateEnd = date('Y-m-d', strtotime("01/01/2005"));
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["Name"])) {
            $nameErr = "Name is required";
        } 
        else{
            $name=$_POST["Name"];
            // check if name only contains letters and whitespace
            if(!preg_match("/^[a-zA-Z' ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed";
            }
            elseif(str_word_count($_POST["Name"])<2){
                $nameErr="Name is too short";
            }
        }
        if(empty($_POST["Email"])) {
            $emailErr = "Email is required";
        } 
        else{
            $email = $_POST["Email"];
            // check if e-mail address is well-formed
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        } 
        if(empty($_POST["Gender"])){
            $genderErr = "Gender is required";
        } 
        else{
            $gender = $_POST["Gender"];
        }
        $datefromform=$_POST['DateOfBirth'];
        if(empty($datefromform)){
            $dateErr="Date can't be empty";
        }
        elseif($datefromform<$DateBegin || $datefromform>$DateEnd){
            $dateErr="Invalid Date";
        }
        $userexist=false;
        $emailexist=false;
        $data=showUserByEmail($_SESSION['Email']);  
        if($data['Username']!=$_SESSION['Username'])$emailexist=true;
        if($emailexist==true){
            $emailErr="Email Exists";
        }
        else{  
            if(empty($nameErr)&&empty($passwordErr)&&empty($confirmpasswordErr)&&empty($emailErr)&&empty($genderErr)&&empty($usernameErr)&&empty($dateErr)){  
                $extra = array(  
                    'Name'             =>     $_POST['Name'],  
                    'Email'          =>     $_POST["Email"],
                    'Password'      =>     $_SESSION["Password"],  
                    'Username'    =>     $_SESSION["Username"],
                    'Gender'    =>     $_POST["Gender"],  
                    'DateOfBirth'     =>     $_POST["DateOfBirth"],
                );
                UpdateUserFromController($_SESSION['Username'],$extra);       
                $_SESSION['Name']= $_POST['Name'];
                $_SESSION['Email']=$_POST["Email"];
                $_SESSION['Gender']=$_POST["Gender"];  
                $_SESSION['DateOfBirth']=$_POST["DateOfBirth"];
                setcookie('Name',$_SESSION["Name"],time()+1000);
                setcookie('Email',$_SESSION["Email"],time()+1000);
                setcookie('Gender',$_SESSION["Gender"],time()+1000);
                setcookie('DateOfBirth',$_SESSION["DateOfBirth"],time()+1000);
                header('Location:editProfile.php');
            }
            else{
                $errorJSON="Errors";
            }
        }
        
    }
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
			<td colspan="2" align="center" class="SecondaryFont">
				<br>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<fieldset style="width: 50%">
                        <legend> <p colour="#080A0B"<b>EDIT PROFILE </b></p> </legend>
						<table>
							<tr>
								<td>Name </td>
								<td>: &nbsp <input type="text" name="Name" value="<?php echo $_SESSION['Name']; ?>"  size="35%"> 
								<br/></td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> Email </td>
								<td> : &nbsp <input type="email" name="Email" value="<?php echo $_SESSION['Email']; ?>" size="35%"> 
								<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
					</table>
						<fieldset>
							<legend>Gender</legend>
					            <input type="radio" name="Gender" value="Male" <?php if(isset($_SESSION['Gender']) && $_SESSION['Gender'] === "Male") { echo "checked";}?>> Male
					            <input type="radio" name="Gender" value="Female" <?php if(isset($_SESSION['Gender']) && $_SESSION['Gender'] === "Female") { echo "checked";}?>> Female
					            <input type="radio" name="Gender" value="Others" <?php if(isset($_SESSION['Gender']) && $_SESSION['Gender'] === "Others" ) { echo "checked";}?>> Others
						</fieldset>
						<fieldset>
							<legend>Date of Birth</legend>
                                <input type="date" name="DateOfBirth" value ="<?php echo $_SESSION['DateOfBirth'];?>">
						</fieldset>
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