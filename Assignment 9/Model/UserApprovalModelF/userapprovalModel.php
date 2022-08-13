<?php 
require_once 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Model\db_connect.php';
function showAllUserApprovals(){
	$conn = db_conn();
    $selectQuery = 'SELECT * FROM `userapproval` ';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function showUserApprovalByUsername($Username){
	$conn = db_conn();
	$selectQuery = "SELECT * FROM `userapproval` where Username = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$Username]);
    }catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function showUserApprovalByEmail($Email){
	$conn = db_conn();
	$selectQuery = "SELECT * FROM `userapproval` where Email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$Email]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function searchUserApproval($Username){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `userapproval` WHERE Username LIKE '%$Username%'";
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function updateUserApproval($Username,$data){
    $conn = db_conn();
    $selectQuery = "UPDATE userapproval set Name = ?, Email = ?, Password = ?, DateOfBirth = ?, Gender = ?, BloodGroup = ?, Role = ?, PicturePath = ? where Username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
        	$data['Name'],$data['Email'],$data['Password'],$data['DateOfBirth'],$data['Gender'],$data['BloodGroup'],$data['Role'],$data['PicturePath'],$Username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}
function deleteUserApproval($Username){
	$conn = db_conn();
    $selectQuery = "DELETE FROM `userapproval` WHERE `Username` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$Username]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}
function addUserApproval($data){
	$conn = db_conn();
    $selectQuery = "INSERT into userapproval(Name,Username,Email,Password,DateOfBirth,Gender,BloodGroup,Role,PicturePath)VALUES(:Name, :Username, :Email, :Password, :DateOfBirth, :Gender, :BloodGroup, :Role, :PicturePath)";
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