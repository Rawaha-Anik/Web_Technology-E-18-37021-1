<?php  
require_once '../Model/model.php';
if (isset($_POST['updateProduct'])) {
	$data['ProductName'] = $_POST['ProductName'];
	$data['ProductId'] = $_GET['ProductId'];
	$data['BuyingPrice'] = $_POST['BuyingPrice'];
	// $data['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost" => 12]);;
    $data['SellingPrice'] = $_POST['SellingPrice'];
    $data['Profit'] = $data['SellingPrice']-$data['BuyingPrice'];
  	if(updateProduct($_GET['ProductId'],$data)){
  	echo 'Successfully updated!!';
  	//redirect to showStudent
  	//header('Location: ../showProduct.php?ProductId='.$_GET["ProductId"]);
  }
} else {
	echo 'You are not allowed to access this page.';
}
?>