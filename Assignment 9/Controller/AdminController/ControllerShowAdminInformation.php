<?php
    include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Model\AdminModelF\adminModel.php';
    function ControllerShowAllAdmins(){
        $rows=showAllAdmins();
        return $rows;
    }
    function ControllerShowAdminByUsername($Username){
        $rows=showAdminByUsername($Username);
        return $rows;
    }
    function ControllerShowAdminByEmail($Email){
        $rows=showAdminByEmail($Email);
        return $rows;
    }
?>