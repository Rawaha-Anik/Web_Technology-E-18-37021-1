<?php  
require_once '../Model/model.php';
if (isset($_POST['createProduct'])){
	$data['ProductName'] = $_POST['ProductName'];
	$data['BuyingPrice'] = $_POST['BuyingPrice'];
	$data['SellingPrice'] = $_POST['SellingPrice'];
	$rows=showAllProducts();
	$newProductId=0;
	foreach($rows as $i => $product){
		$newProductId=max($newProductId,$product['ProductId']);
	}
	$data['ProductId']=$newProductId+1;
	$data['Profit'] = $_POST['SellingPrice']-$_POST['BuyingPrice'];
    if(addProduct($data)){
     	echo 'Successfully added!!';
    }
    else{
    	echo 'You are not allowed to access this page.';
    }
}
?>