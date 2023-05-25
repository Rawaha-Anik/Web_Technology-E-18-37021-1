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
        include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Controller\UserApprovalController\ControllerShowUserApprovalInformation.php';
        $data=ControllerShowAllUserApprovals();
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
                <td colspan="2">
                    <table border="1px solid">
	                <thead>
		                <tr>
		                	<th>Name</th>
		                	<th>Username</th>
                            <th>Email</th>
			                <th>Date Of Birth</th>
                            <th>Gender</th>
		                	<th>Role</th>
                            <th>Blood Group</th>
                            <th>Action</th>
		                </tr>
	                </thead>
                	<tbody>
	                	<?php foreach ($data as $i => $user): ?>
			            <tr>
		            		<td><?php echo $user['Name'] ?></td>
				            <td><?php echo $user['Username'] ?></td>
                            <td><?php echo $user['Email'] ?></td>
				            <td><?php echo $user['DateOfBirth'] ?></td>
				            <td><?php echo $user['Gender'] ?></td>
                            <td><?php echo $user['Role'] ?></td>
                            <td><?php echo $user['BloodGroup'] ?></td>
				            <td><a href="acceptUserApproval.php?Username=<?php echo $user['Username']?>">Approve</a>&nbsp<a href="removeUserApproval.php?Username=<?php echo $user['Username'] ?>" onclick="return confirm('Are you sure want to delete this ?')">Delete</a></td>
			            </tr>
		                <?php endforeach; ?>
                	</tbody>
                    </table>
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