<?php
    $usr=$_GET["Username"];
    include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Controller\UserController\ControllerRemoveUser.php';
    ControllerDeleteUser($usr);
    header('Location: ShowAllUsers.php');
?>