<?php
require_once '../Model/model.php';
if (isset($_POST['findProduct'])) {
    try {
    	$allSearchedProducts = searchProduct($_POST['ProductName']);
    	require_once '../View/showSearchedProduct.php';
    }catch(Exception $ex) {
    	echo $ex->getMessage();
    }
}

