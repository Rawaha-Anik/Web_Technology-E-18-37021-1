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
		$_SESSION['BloodGroup'] =$_COOKIE["BloodGroup"];
		$_SESSION['Role'] =$_COOKIE["Role"];
		///$_SESSION['PicturePath'] =$_COOKIE["PicturePath"];
?>
    <?php
        include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Controller\UserController\ControllerShowUserInformation.php';
        $username=$_GET["Username"];
        $data=ControllerShowUserByUsername($username);
        var_dump($data);
    ?>
    <?php
        $nameErr = $emailErr = $genderErr = $usernameErr = $passwordErr=$confirmpasswordErr=$dateErr="";
        $name = $email = $gender = $comment = $website = $username=$password=$confirmpassword=$errorJSON=$message=$selectBloodGroupErr=$selectRoleErr="";
        $DateBegin = date('Y-m-d',strtotime("01/01/1953"));
        $DateEnd = date('Y-m-d', strtotime("01/01/2005"));
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["Name"])) {
                $nameErr = "Name is required";
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
            if(empty($_POST["BloodGroup"])){
                $selectBloodGroupErr="Must select a type";
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
            if(empty($_POST["Role"])){
                $selectRoleErr="Role Must Be Selected";
            }
            $userexist=false;
            $emailexist=false;
            $data2=showUserByEmail($data['Email']);  
            if($data2['Username']!=$data['Username'])$emailexist=true;
            if($emailexist==true){
                $emailErr="Email Exists";
                 header("Location : editUser.php?Username=".$data["Username"]);
            }
            else{ 
                if(empty($nameErr)&&empty($passwordErr)&&empty($confirmpasswordErr)&&empty($emailErr)&&empty($genderErr)&&empty($usernameErr)&&empty($dateErr)){  
                    $extra = array(  
                        'Name'             =>    $_POST['Name'],  
                        'Email'          =>    $_POST["Email"],
                        'Password'      =>    $data["Password"],
                        'Username'    =>    $data["Username"],
                        'Gender'    =>    $_POST["Gender"],  
                        'DateOfBirth'  =>  $_POST["DateOfBirth"],
                        'Role'   =>   $_POST["Role"],
                        'BloodGroup'     =>   $_POST["BloodGroup"],
                        'PicturePath'  =>  ""
                    );
                    updateUser($data['Username'],$extra);  
                    header("Location : ShowAllUsers.php"); 
                }
                else{
                    ///header("Location : editUser.php?Username=".$data["Username"]);
                }
            }
        }
    ?>








    <!DOCTYPE html>
    <html>
    <head>
        <title>Home</title>
        <style>

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
                <td width="30%">
                    <?php
                        include 'dashboardoptions.php';
                    ?>
                </td>
                <td colspan="2" align="center" class="SecondaryFont">
				<br>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<fieldset style="width: 50%">
                        <legend> <p colour="#080A0B"<b>EDIT User </b></p> </legend>
						<table>
							<tr>
								<td>Name </td>
								<td>: &nbsp <input type="text" name="Name" id ="Name" value="<?php echo $data['Name']; ?>"  size="35%"> 
                                <span class="error">* <?php echo $nameErr;?></span><br>
								<br/></td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
							<tr>
								<td> Email </td>
								<td> : &nbsp <input type="email" name="Email" id="Email" value="<?php echo $data['Email']; ?>" size="35%"> 
                                <span class="error">* <?php echo $emailErr;?></span><br>
								<br/> </td>
							</tr>
							<tr> <td colspan="2"> <hr> </td> </tr>
					</table>
						<fieldset>
							<legend>Gender</legend>
					            <input type="radio" name="Gender" id="Gender" value="Male" <?php if(isset($data['Gender']) && $data['Gender'] === "Male") { echo "checked";}?>> Male
					            <input type="radio" name="Gender" id="Gender" value="Female" <?php if(isset($data['Gender']) && $data['Gender'] === "Female") { echo "checked";}?>> Female
					            <input type="radio" name="Gender" id="Gender" value="Others" <?php if(isset($data['Gender']) && $data['Gender'] === "Others" ) { echo "checked";}?>> Others
                                <span class="error">* <?php echo $genderErr;?></span><br>
						</fieldset>
						<fieldset>
							<legend>Date of Birth</legend>
                            <input type="date" name="DateOfBirth" id="DateOfBirth" value ="<?php echo $data['DateOfBirth'];?>">
                            <span class="error">* <?php echo $dateErr;?></span><br>
						</fieldset>
                        
                        <fieldset style="width: 50%" class="field_set" align="left">
    				        <legend>User Type:</legend> 
   					         <select name ="Role" id="Role">
        		        		<option value=""></option>
        		        		<option value="Customer">Customer</option>
        		        		<option value="Sales Manager">Sales Manager</option>
        		        		<option value="Buying Agent">Buying Agent</option>
    			        	</select>
    			        	<span class="error">* <?php echo $selectRoleErr;?></span><br>
  				        </fieldset><br>

                        <fieldset style="width: 50%" class="field_set" align="left">
    	    			    <legend>Blood Group:</legend> 
   		    			    <select name ="BloodGroup" id="BloodGroup" value="<?php echo $data['BloodGroup'];?>">
        	    		    	<option value=""></option>
        	    		    	<option value="B+">B+</option>
        	    		    	<option value="AB+">AB+</option>
        	    		    	<option value="A+">A+</option>
			    		    	<option value="O+">O+</option>
        	    		     	<option value="O-">O-</option>
        	    			    <option value="A-">A-</option>
			    			    <option value="AB-">AB-</option>
        	    			    <option value="B-">B-</option>
    				        </select>
    				        <span class="error">* <?php echo $selectBloodGroupErr;?></span><br>
                        </fieldset>
					<hr>
					<input type="submit" name="Submit" value="Submit">
				</fieldset>
				</form>
				<br> 
			</td>
            </tr>
            <tr height = "50px">
                <td colspan="3" >
                    <center> Copyright &copy 2022 </center>
                </td>
            </tr>
        </table>
    </body>
    </html>
<?php
}
else{
	echo "Please do Registration before login in";
}
?>