<?php
    $usr=$_GET["Username"];
    include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Controller\UserApprovalController\ControllerRemoveUserApproval.php';
    ControllerDeleteUserApproval($usr);
    header('Location: ApproveRegistrations.php');
?>