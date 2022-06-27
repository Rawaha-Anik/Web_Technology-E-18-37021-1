<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
<h1 align="center">Change Password</h1>
<?php
        // define variables and set to empty values
        $currentPasswordErr=$newpasswordErr=$retypenewpasswordErr="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["CurrentPassword"])) {
                $currentPasswordErr = "Please Fill Up The Block";
            }
            if(empty($_POST["NewPassword"])) {
                $newpasswordErr = "Please Fill Up The Block";
            }
            elseif($_POST["NewPassword"]==$_POST["CurrentPassword"]){
                $newpasswordErr = "You can't use your current password";
            }  
            if(empty($_POST["RetypeNewPassword"])) {
                $retypenewpasswordErr = "Please Fill Up The Block";
            }
            elseif($_POST["RetypeNewPassword"]!=$_POST["NewPassword"]){
                $retypenewpasswordErr = "Passwords didn't match";
            }
        }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset>
        Current Password: 
        <input type="password" name="CurrentPassword">
        <span class="error">*<?php echo $currentPasswordErr;?></span>
        </fieldset><br>
        <fieldset>
        New Password: <input type="password" name="NewPassword">
        <span class="error">* <?php echo $newpasswordErr;?></span>
        </fieldset><br>
        <fieldset>
        Retype New Password: <input type="password" name="RetypeNewPassword">
        <span class="error">* <?php echo $retypenewpasswordErr;?></span>
        </fieldset><br>
        <fieldset>
        <input type="submit" name="submit" value="Submit">  
        </fieldset>
    </form>
</body>
</html>