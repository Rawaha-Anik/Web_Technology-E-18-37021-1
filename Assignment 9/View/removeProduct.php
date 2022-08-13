<?php
    $usr=$_GET["ProductId"];
    include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Controller\ProductController\ControllerRemoveProduct.php';
    ControllerDeleteProduct($usr);
    header('Location: ShowAllProducts.php');
?>