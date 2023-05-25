<?php
    include 'D:\XAMPP\htdocs\FinalTerm\ProjectFinal\Model\UserApprovalModelF\userapprovalModel.php';
    function ControllerShowAllUserApprovals(){
        $rows=showAllUserApprovals();
        return $rows;
    }
    function ControllerShowUserApprovalByUsername($Username){
        $rows=showUserApprovalByUsername($Username);
        return $rows;
    }
    function ControllerShowUserApprovalByEmail($Email){
        $rows=showUserApprovalByEmail($Email);
        return $rows;
    }
?>