<?php 
require_once 'db_connect.php';
function showAllUsers(){
	$conn = db_conn();
    $selectQuery = 'SELECT * FROM `userinfo` ';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function showUserByUsername($Username){
	$conn = db_conn();
	$selectQuery = "SELECT * FROM `userinfo` where Username = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$Username]);
    }catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function showUserByEmail($Email){
	$conn = db_conn();
	$selectQuery = "SELECT * FROM `userinfo` where Email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$Email]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function searchUser($Username){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `userinfo` WHERE Username LIKE '%$Username%'";
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function addUser($data){
	$conn = db_conn();
    $selectQuery = "INSERT into userinfo(Name,Username,Email,Password,Gender,DateOfBirth)
VALUES (:Name, :Username, :Email, :Password, :Gender, :DateOfBirth)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Name' => $data['Name'],
        	':Username' => $data['Username'],
        	':Email' => $data['Email'],
        	':Password' => $data['Password'],
        	':Gender' => $data['Gender'],
        	':DateOfBirth' => $data['DateOfBirth']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}
function updateUser($Username,$data){
    $conn = db_conn();
    $selectQuery = "UPDATE userinfo set Name = ?, Email = ?, Password = ?, Gender = ?, DateOfBirth = ? where Username = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
        	$data['Name'],$data['Email'], $data['Password'], $data['Gender'],$data['DateOfBirth'],$Username
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}
function deleteUser($Username){
	$conn = db_conn();
    $selectQuery = "DELETE FROM `userinfo` WHERE `Username` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$Username]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}