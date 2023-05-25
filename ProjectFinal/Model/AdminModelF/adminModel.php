<?php 
require_once 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Model\db_connect.php';
function showAllAdmins(){
	$conn = db_conn();
    $selectQuery = 'SELECT * FROM `admin` ';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function showAdminByUsername($Username){
	$conn = db_conn();
	$selectQuery = "SELECT * FROM `admin` where Username = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$Username]);
    }catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function showAdminByEmail($Email){
	$conn = db_conn();
	$selectQuery = "SELECT * FROM `admin` where Email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$Email]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function searchAdmin($Username){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `admin` WHERE Username LIKE '%$Username%'";
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function updateAdmin($Username,$data){
    $conn = db_conn();
    $selectQuery = "UPDATE admin set Name = ?, Email = ?, Password = ?, DateOfBirth = ?, Gender = ?, BloodGroup = ?, Role = ?, PicturePath = ? where Username = ?";
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