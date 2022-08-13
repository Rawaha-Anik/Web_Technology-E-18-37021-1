
<?php
include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Controller\UserApprovalController\ControllerShowUserApprovalInformation.php';
function addUser($data){
	$conn = db_conn();
    $selectQuery = "INSERT into userinfo(Name,Username,Email,Password,DateOfBirth,Gender,BloodGroup,Role,PicturePath)VALUES(:Name, :Username, :Email, :Password, :DateOfBirth, :Gender, :BloodGroup, :Role, :PicturePath)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Name' => $data['Name'],
        	':Username' => $data['Username'],
        	':Email' => $data['Email'],
        	':Password' => $data['Password'],
        	':DateOfBirth' => $data['DateOfBirth'],
            ':Gender' => $data['Gender'],
            ':BloodGroup' => $data['BloodGroup'],
            ':Role' => $data['Role'],
            ':PicturePath' => $data['PicturePath']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}
?>
<?php
    $username=$_GET["Username"];
    $data=ControllerShowUserApprovalByUsername($username);
    deleteUserApproval($data['Username']);
    addUser($data);
    header("Location:ApproveRegistrations.php");
?>