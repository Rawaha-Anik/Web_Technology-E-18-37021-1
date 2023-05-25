<?php  
    require_once 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Model\ProductModelF\productModel.php';
    function ControllerShowAllProducts(){
        $data=showAllProducts();
        return $data;
    }
    function ControllerShowProdutById($id){
        $data=showProductById($id);
        return $data;
    }
    function ControllerShowProductByProductType($id){
        $data=showProductByProductType($id);
        return $data;
    }
?>