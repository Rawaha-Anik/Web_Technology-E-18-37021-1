<?php
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .Coloring{color: #ECF0F1;font-size:5vw;}
        .FontChange{color: #121715;font-size:2.5vw;}
        .field_set{border-color:#090A09;}
        .error {color: #ECF0F1;}
    </style>
</head>
<body>
	<h4  class="FontChange"> &nbsp &nbsp &nbsp Account </h4>
    <hr width="90%">
    <ul>
        <li> <a href="viewprofile.php"  class="FontChange"> View Profile </a></li>
        <li> <a href="Editprofile.php" class="FontChange"> Edit Profile </a> </li>
        <li> <a href="ChangePassword.php" class="FontChange"> Change Password </a> </li>
    </ul>
</body>
</html>
<?php
    }
    else{
        echo "Please Login First";
    }
?>