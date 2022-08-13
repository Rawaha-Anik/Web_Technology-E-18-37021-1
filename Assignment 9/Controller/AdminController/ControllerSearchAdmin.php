<?php
    include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Model\AdminModelF\adminModel.php';
    function ControllerSearchAdmin($Username){
        $rows=searchAdmin($Username);
        return $rows;
    }  
?>