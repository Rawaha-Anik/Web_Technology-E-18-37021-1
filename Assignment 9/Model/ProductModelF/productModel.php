<?php 
require_once 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Model\db_connect.php';
function showAllProducts(){
	$conn = db_conn();
    $selectQuery = 'SELECT * FROM `productinfo` ';
    try{
        $stmt = $conn->query($selectQuery);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function showProductById($id){
	$conn = db_conn();
	$selectQuery = "SELECT * FROM `productinfo` where ProductId = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function showProductByProductType($id){
	$conn = db_conn();
	$selectQuery = "SELECT * FROM `productinfo` where ProductType = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function searchProduct($product_name){
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `productinfo` WHERE ProductName LIKE '%$product_name%'";
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
    $selectQuery = "INSERT into productinfo(ProductName,ProductId,ProductDate,ProductBuyingPrice,ProductSellingPrice,ProductType,ProductQuantity,ProductAvailability)
VALUES (:ProductName, :ProductId,:ProductDate, :ProductBuyingPrice, :ProductSellingPrice, :ProductType, :ProductQuantity, :ProductAvailability)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
        	':ProductName' => $data['ProductName'],
        	':ProductId' => $data['ProductId'],
            ':ProductDate' => $data['ProductDate'],
        	':ProductBuyingPrice' => $data['ProductBuyingPrice'],
        	':ProductSellingPrice' => $data['ProductSellingPrice'],
            ':ProductType'  => $data['ProductType'],
            ':ProductQuantity'  => $data['ProductQuantity'],
        	':ProductAvailability' => $data['ProductAvailability']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}
function updateProduct($ProductId,$data){
    $conn = db_conn();
    $selectQuery = "UPDATE productinfo set ProductName = ?, ProductDate = ?, ProductBuyingPrice = ?, ProductSellingPrice = ?, ProductType = ?, ProductQuantity = ?, ProductAvaiability = ? where ProductId = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
        	$data['ProductName'],$data['ProductDate'],$data['ProductBuyingPrice'], $data['ProductSellingPrice'], $data['ProductType'], $data['ProductQuantity'] , $data['ProductAvailability'],$ProductId
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}
function deleteProduct($id){
	$conn = db_conn();
    $selectQuery = "DELETE FROM `productinfo` WHERE `ProductId` = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}