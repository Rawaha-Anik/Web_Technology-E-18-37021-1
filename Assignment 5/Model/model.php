<?php 
require_once 'db_connect.php';
function showAllProducts(){
	$conn = db_conn();
    $selectQuery = 'SELECT * FROM `product` ';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function showProduct($id){
	$conn = db_conn();
	$selectQuery = "SELECT * FROM `product` where ProductId = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function searchProduct($product_name){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `product` WHERE ProductName LIKE '%$product_name%'";
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function addProduct($data){
	$conn = db_conn();
    $selectQuery = "INSERT into product (ProductName,ProductId,BuyingPrice,SellingPrice,Profit)
VALUES (:ProductName, :ProductId, :BuyingPrice, :SellingPrice, :Profit)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
        	':ProductName' => $data['ProductName'],
        	':ProductId' => $data['ProductId'],
        	':BuyingPrice' => $data['BuyingPrice'],
        	':SellingPrice' => $data['SellingPrice'],
        	':Profit' => $data['Profit']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}
function updateProduct($ProductId,$data){
    $conn = db_conn();
    $selectQuery = "UPDATE product set ProductName = ?, BuyingPrice = ?, SellingPrice = ?, Profit = ? where ProductId = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
        	$data['ProductName'],$data['BuyingPrice'], $data['SellingPrice'], $data['Profit'],$ProductId
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}
function deleteProduct($id){
	$conn = db_conn();
    $selectQuery = "DELETE FROM `product` WHERE `ProductId` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}