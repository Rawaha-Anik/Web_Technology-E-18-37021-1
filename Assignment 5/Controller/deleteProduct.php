<?php 
require_once '../Model/model.php';
if(deleteProduct($_GET['ProductId'])) {
    header('Location: ../View/showAllProducts.php');
}
 ?>