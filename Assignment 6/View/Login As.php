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
        <title>Login As</title>
        <style>
            
        </style>
    </head>
    <body>
        <a href="PublicHome.php"><img src="logo.JPG" align="left" height="200px" width="200px"> </a>
        <p >Logged in as <?php echo $_SESSION['Username']?>
        &nbsp | &nbsp
        <a href="logout.php" >Logout</a>
        &nbsp</p>
    </body>
    </html>
<?php
    }
else{
    echo "Please do Registration before login in";
}
?>
