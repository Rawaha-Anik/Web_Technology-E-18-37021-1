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
                <td width="33%">
                    <?php
                        include 'sideoptions.php';
                    ?>
                </td>
                <td colspan="2">
                    <h3>
                        &nbsp &nbsp Welcome <?php echo $_SESSION['Username']?>
                    </h3> 
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