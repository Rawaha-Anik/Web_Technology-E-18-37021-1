<?php
	$nameErr=$name=$emailErr=$email=$username=$usernameErr=$password=$passwordErr=$confirmpassword=$confirmpasswordErr="";
	$date=$dateErr=$gender=$genderErr=$dateErr=$selectRoleErr=$selectBloodGroupErr="";
	$DateBegin = date('Y-m-d',strtotime("01/01/1953"));
    $DateEnd = date('Y-m-d', strtotime("01/01/2005"));
	$role="Customer";
	$bloodgroup="B+";
	$gender="Male";
	$datefromform=date('Y-m-d',strtotime("01/01/2000"));
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
		elseif($_POST["Username"]==='Dufaux'){
			$usernameErr="Username Already Exists";
			$allOk=false;
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
		if(empty($_POST["Role"])){
			$selectRoleErr="Must select a type";
			$allOk=false;
		}
		if(empty($_POST["BloodGroup"])){
			$selectBloodGroupErr="Must select a type";
			$allOk=false;
		}
		if($allOk === true){
			$userexist=false;
            $emailexist=false;
			include '../Controller/UserController/ControllerShowUserInformation.php';
			$row1="";
			$row2="";
			$row1=ControllerShowUserByUsername($username);
			$row2=ControllerShowUserByEmail($email);
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
                if(empty($selectBloodGroupErr)&&empty($selectErr)&&empty($nameErr)&&empty($passwordErr)&&empty($selectErr)&&empty($confirmpasswordErr)&&empty($emailErr)&&empty($genderErr)&&empty($usernameErr)&&empty($dateErr)){  
                    $extra = array(  
                    'Name'             =>     $_POST['Name'],  
					'Username'  	  =>     $_POST["Username"],
					'Email'        	 =>     $_POST["Email"],
					'Password'      =>     $_POST["Password"],  
					'Gender'   	 =>  	   $_POST["Gender"],  
					'DateOfBirth'  =>     $_POST["DateOfBirth"],
					'Role'  => $_POST["Role"],
					'BloodGroup' => $_POST['BloodGroup'],
					'PicturePath' => ""  
					);
                    addUser($extra);
					header("Location:AddUser.php");
				}
            }
		}
	} 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
    <style>
        .Coloring{color: #ECF0F1;font-size:5vw;}
        .FontChange{color: #ECF0F1;font-size:2.5vw;}
        .field_set{border-color:#090A09;color: #080A0B;}
        .error{color: #122aa6;}
		hr{background-color: #a61224;}
    </style>
	<script>
		let x=0;
		function CheckName(){
			if(document.getElementById("Name").value==""){
				document.getElementById("Name").style.borderColor="red";
				document.getElementById("namespan").innerHTML="Name Can't Be Empty";
			}
			else if(document.getElementById("Name").value.split(' ').length<2){
				document.getElementById("Name").style.borderColor="red";
				document.getElementById("namespan").innerHTML="Name Must Be Of Atleast 2 words";
			}
			else{
				document.getElementById("Name").style.borderColor="black";
				document.getElementById("namespan").innerHTML="";
			}
		}
		function CheckUsername(){
			if(document.getElementById("Username").value==""){
				document.getElementById("Username").style.borderColor="red";
				document.getElementById("usernamespan").innerHTML="Username Can't Be Empty";
			}
			else if(document.getElementById("Username").value.length<2){
				document.getElementById("Username").style.borderColor="red";
				document.getElementById("usernamespan").innerHTML="Username Must Be Of Atleast 2 Characters";
			}
			else{
				document.getElementById("Username").style.borderColor="black";
				document.getElementById("usernamespan").innerHTML="";
			}
		}
		function CheckEmail(){
			let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
			if(document.getElementById("Email").value.match(validRegex)){
				document.getElementById("Email").style.borderColor="black";
				document.getElementById("emailspan").innerHTML="";
			}
			else{
				document.getElementById("Email").style.borderColor="red";
				document.getElementById("emailspan").innerHTML="Invalid Email Format";
			}
		}
		function CheckPassword(){
			if(document.getElementById("Password").value==""){
				document.getElementById("Password").style.borderColor="red";
				document.getElementById("passwordspan").innerHTML="Password Can't Be Empty";
			}
			else{
				document.getElementById("Password").style.borderColor="black";
				document.getElementById("passwordspan").innerHTML="";
			}
		}
		function CheckCPassword(){
			if(document.getElementById("Password").value===document.getElementById("cPassword").value &&document.getElementById("cPassword").value.length>0){
				document.getElementById("cPassword").style.borderColor="black";
				document.getElementById("cpasswordspan").innerHTML="";
			}
			else{
				document.getElementById("cPassword").style.borderColor="red";
				document.getElementById("cpasswordspan").innerHTML="Passwords didn't match";
			}
		}
		
		function showHint(str) {
			if(str.length == 0) {
				document.getElementById("usernamespan").innerHTML = "";
				return;
			} 
			else{
				const xmlhttp = new XMLHttpRequest();
				xmlhttp.onload = function(){
				document.getElementById("usernamespan").innerHTML = "Suggetion: "+this.responseText;
			}
			xmlhttp.open("GET", "gethint.php?q=" + str);
			xmlhttp.send();
			}
		}

		function validateForm(){
 			let x = document.forms["myForm"]["Name"].value;
			let k=true;
  			if(x==""){
    			document.getElementById("Name").style.borderColor="red";
				document.getElementById("namespan").innerHTML="Name Can't Be Empty";
				k&=false;
  			}
			else if(x.split(' ').length<2){
				document.getElementById("Name").style.borderColor="red";
				document.getElementById("namespan").innerHTML="Name Must Be Of Atleast 2 words";
				k&=false;
			}
			else{
				document.getElementById("Name").style.borderColor="black";
				document.getElementById("namespan").innerHTML="";
				k&=true;
			}
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
			x = document.forms["myForm"]["Email"].value;
			let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
			if(x.match(validRegex)){
				document.getElementById("Email").style.borderColor="black";
				document.getElementById("emailspan").innerHTML="";
				k&=true;
			}
			else{
				document.getElementById("Email").style.borderColor="red";
				document.getElementById("emailspan").innerHTML="Invalid Email Format";
				k&=false;
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
			x = document.forms["myForm"]["cPassword"].value;
			if(document.getElementById("Password").value===x &&x.length>0){
				document.getElementById("cPassword").style.borderColor="black";
				document.getElementById("cpasswordspan").innerHTML="";
				k&=true;
			}
			else{
				k&=false;
				document.getElementById("cPassword").style.borderColor="red";
				document.getElementById("cpasswordspan").innerHTML="Passwords didn't match";
			}
			if(k==1)return true;
			return false;
		}
	</script>
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
		<tr height = "500px">
			<td colspan="2" align="center">
				<br>
				<form method="POST" action="" onsubmit="return validateForm()" name="myForm">
				<fieldset style="width: 50%" class="field_set">
					<legend> <b>Add User</b></legend>
						<table>
							<tr>
								<td> Name </td>
								<td>
								:<input type="text" name="Name" id="Name" onkeyup="Checkname()" onblur="CheckName()" onblur="CheckEverything()" value="<?php echo $name;?>">
    							<span class="error" id="namespan"></span>
    							<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> Email </td>
								<td> :<input type="email" id="Email" name="Email" onload="CheckEmail()" onkeyup="CheckEmail()" onblur="CheckEmail()" value="<?php echo $email;?>"> 
								<span class="error" id="emailspan"></span>
								<br/></td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> User Name </td>
								<td> :<input type="text" name="Username" id="Username"  onkeyup="showHint(this.value)" onblur="showHint(this.value)" value="<?php echo $username;?>"> 
								<span class="error" id="usernamespan"></span>
								<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> Password </td>
								<td> :<input type="password" name="Password" id="Password" onblur="CheckPassword()" onkeyup="CheckPassword()"> 
								<span class="error" id="passwordspan"></span>
								<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> Confirm Password </td>
								<td> :<input type="password" name="cPassword" id="cPassword" onblur="CheckCPassword()" onkeyup="CheckCPassword()" onkeypress="CheckCPassword()"> 
								<span class="error" id="cpasswordspan"></span>
								<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
					</table>
					<fieldset style="width: 50%" class="field_set" align="left">
   						<legend>Gender:</legend>
    					<input type="radio" name="Gender" id="Gender" <?php if (isset($gender) && $gender=="Female") echo "checked";?> value="Female">Female
    					<input type="radio" name="Gender" id="Gender" <?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">Male
    					<input type="radio" name="Gender" id="Gender" <?php if (isset($gender) && $gender=="Other") echo "checked";?> value="Other">Other  
    				</fieldset>

					<fieldset style="width: 50%" class="field_set" align="left">
 				   	<legend>Date:</legend>
    				<input name="DateOfBirth" id="DateOfBirth" type="date" value="<?php echo $datefromform;?>">
    				<span class="error" id="dateofbirthspan"><?php echo $dateErr; ?></span>
    				</fieldset><br>
					<fieldset style="width: 50%" class="field_set" align="left">
    				<legend>User Type:</legend> 
   					 <select name ="Role" id="Role">
        				<option value="Customer"<?php if($role=="Customer"){echo('selected="selected"');}?>>Customer</option>
        				<option value="Sales Manager"<?php if($role=="Sales Manager"){echo('selected="selected"');}?>>Sales Manager</option>
        				<option value="Buying Agent"<?php if($role=="Buying Agent"){echo('selected="selected"');}?>>Buying Agent</option>
    				</select>
    				<span class="error">* <?php echo $selectRoleErr;?></span><br>
  				    </fieldset><br>
					<fieldset style="width: 50%" class="field_set" align="left">
    				<legend>Blood Group:</legend> 
   					 <select name ="BloodGroup" id="BloodGroup">
        				<option value="B+"<?php if($bloodgroup=="B+"){echo('selected="selected"');}?>>B+</option>
        				<option value="AB+"<?php if($bloodgroup=="AB+"){echo('selected="selected"');}?>>AB+</option>
        				<option value="A+"<?php if($bloodgroup=="A+"){echo('selected="selected"');}?>>A+</option>
						<option value="O+"<?php if($bloodgroup=="O+"){echo('selected="selected"');}?>>O+</option>
        				<option value="O-"<?php if($bloodgroup=="O-"){echo('selected="selected"');}?>>O-</option>
        				<option value="A-"<?php if($bloodgroup=="A-"){echo('selected="selected"');}?>>A-</option>
						<option value="AB-"<?php if($bloodgroup=="AB-"){echo('selected="selected"');}?>>AB-</option>
        				<option value="B-"<?php if($bloodgroup=="B-"){echo('selected="selected"');}?>>B-</option>
    				</select>
    				</fieldset><br>
					<hr>
					<input type="reset" name="Reset" value="Reset">
					<input type="submit" name="Submit" id="Submit" value="Submit" >
				</fieldset>
				</form>
			<br>
			</td>
		</tr>
		<tr height = "50px">
			<td colspan="2">
				<center> Copyright &copy 2022 </center>
			</td>
		</tr>
	</table>
</body>
</html>