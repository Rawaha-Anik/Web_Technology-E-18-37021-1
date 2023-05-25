<?php
    include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Model\UserModelF\userModel.php';
    function ControllerSearchUser($Username){
        $rows=searchUser($Username);
        return $rows;
    }  
?>