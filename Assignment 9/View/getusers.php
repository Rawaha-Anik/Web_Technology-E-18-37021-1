<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Controller\UserController\ControllerSearchUser.php';
        $id=$_GET["Username"];
        $data=ControllerSearchUser($id);
        echo "<table border='1px solid'>
	        <thead>
	            <tr>
		            <th>Name</th>
		            <th>Username</th>
                    <th>Email</th>
			        <th>Date Of Birth</th>
		            <th>Gender</th>
                    <th>Blood Group</th>
                    <th>Role</th>
			    </tr>
	        </thead>
            <tbody>";
            foreach($data as $i =>$user):
			        echo "<tr>
		            	<td>"; echo $user["Name"];echo "</td>
				        <td>"; echo $user['Username']; echo "</td>
                        <td>"; echo $user['Email']; echo "</td>
				        <td>"; echo $user['DateOfBirth']; echo "</td>
				        <td>"; echo $user['Gender']; echo "</td>
                        <td>"; echo $user['BloodGroup'];echo "</td>
                        <td>"; echo $user['Role'];echo "</td>
                    </tr>";
		        endforeach;
            echo "</tbody>"
    ?>
</body>
</html>