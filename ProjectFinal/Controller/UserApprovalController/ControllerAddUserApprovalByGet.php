<?php
    include 'ControllerAddUserApproval.php';
    $Username=$_GET["Username"];
    $all_data = file_get_contents("ApproveList.json");  
	$all_data = json_decode($all_data, true); 
    $new_array=[];
    foreach($all_data as $row){
        if($row['Username']==$Username){
            $d_data = array(
                'Name' => $row['Name'],
                'Email' => $row['Email'],
                'Username' => $row['Username'],
                'Password' => $row['Password'],
                'Gender' => $row['Gender'],
                'DateOfBirth' => $row['DateOfBirth'],
                'Role' => $row['Role'],
                'BloodGroup' => $row['BloodGroup'],
                'PicturePath' => $row['PicturePath']
            ); 
            ControllerAddUserApproval($d_data);
        }
        else{
            $new_array[]=$row;
        }
    }
    $final_data = json_encode($new_array);  
  	if(file_put_contents('ApproveList.json',$final_data)){
       	$message = "<h1 style='color:white;'>File Appended Successfully</h1>";  
    	echo $message;
    }
    header('Location: ../../View/Login.php');
?>