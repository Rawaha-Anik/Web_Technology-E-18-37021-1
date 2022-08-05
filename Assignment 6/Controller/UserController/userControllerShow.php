<?php
    include '../Model/model.php';
    function ShowAllUsersFromController()
    {
        $data=showAllUsers();
        return $data;
    }
    function ShowUserByUsernameFromController($Username){
        $data=showUserByUsername($Username);
        return $data;
    }
    function ShowUserByEmailFromController($Email){
        $data=showUserByEmail($Email);
        return $data;
    }
?>