<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
    <?php
        // define variables and set to empty values
        $nameErr = $emailErr = $genderErr = $usernameErr = $passwordErr=$confirmpasswordErr=$dateErr="";
        $name = $email = $gender = $comment = $website = $username=$password=$confirmpassword=$errorJSON=$message="";
        $DateBegin = date('Y-m-d',strtotime("01/01/1953"));
        $DateEnd = date('Y-m-d', strtotime("01/01/2005"));
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["name"])) {
                $nameErr = "Name is required";
            } 
            else{
                $name=$_POST["name"];
                // check if name only contains letters and whitespace
                if(!preg_match("/^[a-zA-Z' ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed";
                }
                elseif(str_word_count($_POST["name"])<2){
                    $nameErr="Name is too short";
                }
            }
            if(empty($_POST["email"])) {
                $emailErr = "Email is required";
            } 
            else{
                $email = $_POST["email"];
                // check if e-mail address is well-formed
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }  
            if(empty($_POST["username"])) {
                $usernameErr = "Username Is Required";
            } 
            else{
                $username=$_POST["username"];
            }
            if(empty($_POST["gender"])){
                $genderErr = "Gender is required";
            } 
            else{
                $gender = $_POST["gender"];
            }
            if(empty($_POST["password"])){
                $passwordErr = "Password is required";
            }
            elseif(strlen($_POST["password"])<8){
                $passwordErr = "Password is too short";
            }
            else{
                $special=false;
                for($i=0;$i<strlen($_POST["password"]);$i++){
                    if($_POST["password"][$i]=='@' || $_POST["password"][$i]=='$' || $_POST["password"][$i]=='#' || $_POST["password"][$i]=='%'){
                        $special=true;
                    }
                }
                if($special==false){
                    $passwordErr="Password Must Contain A Special Character";
                }
                else{
                    $password = $_POST["password"];
                }
            }
            $datefromform=$_POST['date'];
            if(empty($datefromform)){
                $dateErr="Date can't be empty";
            }
            elseif($datefromform<$DateBegin || $datefromform>$DateEnd){
                $dateErr="Invalid Date";
            }
            if(empty($_POST["confirmpassword"])){
                $confirmpasswordErr = "Password is required";
            }
            elseif($_POST["password"]!=$_POST["confirmpassword"]){
                $confirmpasswordErr = "Passwords didn't match";
            }
            if(file_exists('User.json')){
                $userexist=false;
                $emailexist=false;
                $data=file_get_contents("User.json");  
                $data=json_decode($data, true);  
                foreach($data as $row){  
                    if($row["username"]==$_POST["username"]){
                        $userexist=true;
                    }
                    if($row["e-mail"]==$_POST["email"]){
                        $emailexist=true;
                    }           
                }
                if($userexist==true){
                    $usernameErr="Username Exists";
                }
                if($emailexist==true){
                    $emailErr="Email Exists";
                }
                else{  
                    if(empty($nameErr)&&empty($passwordErr)&&empty($confirmpasswordErr)&&empty($emailErr)&&empty($genderErr)&&empty($usernameErr)&&empty($dateErr)){  
                        $current_data = file_get_contents('User.json');  
                        $array_data = json_decode($current_data, true);  
                        $extra = array(  
                        'name'             =>     $_POST['name'],  
                        'e-mail'         =>     $_POST["email"],
                        'password'      =>     $_POST["password"],  
                        'username'    =>     $_POST["username"],
                        'gender'    =>     $_POST["gender"],  
                        'dob'     =>     $_POST["date"]  
                        );  
                        $array_data[] = $extra;  
                        $final_data = json_encode($array_data);  
                        if(file_put_contents('User.json', $final_data)){  
                             $message = "<label class='text-success'>File Appended Success fully</p>";  
                        }
                    }
                    else{
                      $errorJSON="Errors";
                    }  
                }
            }  
            else{  
                $errorJSON='JSON File not exits';  
            }
        }
    ?>
    <h1 align="center">Registration</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset>  
        Name: <input type="text" name="name" value="<?php echo $name;?>">
        <span class="error">* <?php echo $nameErr;?></span>
        </fieldset><br>
        <fieldset>
        E-mail: <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span>
        </fieldset><br>
        <fieldset>
        Username: <input type="text" name="username" value="<?php echo $username;?>">
        <span class="error">* <?php echo $usernameErr;?></span>
        </fieldset><br>
        <fieldset>
        Password: <input type="password" name="password">
        <span class="error">* <?php echo $passwordErr;?></span>
        </fieldset><br>
        <fieldset>
        Confirm Password: <input type="password" name="confirmpassword">
        <span class="error">* <?php echo $confirmpasswordErr;?></span>
        </fieldset><br>
        <fieldset>
        Gender:
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
        <span class="error">* <?php echo $genderErr;?></span>
        </fieldset>
        <br>
        <fieldset>
        Date: 
        <input name="date" id="date" type="date"  value="<?php echo $datefromform;?>">
        <span class="error">* <?php echo $dateErr;?></span>
        </fieldset>
        <input type="submit" name="submit" value="Submit">  
    </form>
    <?php
        echo $errorJSON;
        echo $message;
    ?>
</body>
</html>