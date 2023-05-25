<?php
    include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Model\UserModelF\userModel.php';
    function ControllerShowAllUsers(){
        $rows=showAllUsers();
        return $rows;
    }
    function ControllerShowUserByUsername($Username){
        $rows=showUserByUsername($Username);
        return $rows;
    }
    function ControllerShowUserByEmail($Email){
        $rows=showUserByEmail($Email);
        return $rows;
    }
?>