<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
    <?php
        $usernameErr=$passwordErr=$username="";
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            if(empty($_POST["username"])) {
                $usernameErr = "Username Is Required";
            } 
            else{
                $username=$_POST["username"];
                if(strlen($username)<8){
                    $usernameErr="Username is too short";
                }
                elseif(!preg_match("/^[a-zA-Z\.-_]*$/",$username)) {
                    $usernameErr = "Only Alphaneumeric Characters, period, dash and underscores are allowed only";
                }
                else{
                    $username=$_POST["username"];
                }
            }
            if(empty($_POST["password"])){
                $passwordErr = "Password is required";
            }
            elseif(strlen($_POST["password"])<8){
                $passwordErr = "Password is too short";
            }
            else{
                $f=false;
                for($i=0;$i<strlen($_POST["password"]);$i++){
                    if($_POST["password"][$i]=='@'||$_POST["password"][$i]=='#'||$_POST["password"][$i]=='$'||$_POST["password"][$i]=='%'){
                        $f=true;
                    }
                }
                if($f==false){
                    $passwordErr = "Password Must Contain A Special Character";
                }
            }
        }
    ?>
    <h1 align="center">Login</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset>
        Username: <input type="text" name="username" value="<?php echo $username;?>">
        <span class="error">* <?php echo $usernameErr;?></span>
        </fieldset><br>
        <fieldset>
        Password: <input type="password" name="password">
        <span class="error">* <?php echo $passwordErr;?></span>
        </fieldset><br>
        <fieldset>
        <input type="submit" name="submit" value="Submit">  
        </fieldset>
    </form>
</body>
</html>