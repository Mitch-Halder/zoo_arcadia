<?php
    function checkAccess($allowedRoles) {
        if (!isset($_SESSION['user'])){
            header('Location:login.php');
            exit;
        }
        $userRole=$_SESSION['user']['role'];
        if (!in_array($userRole, $allowedRoles)){
            header('Location:/project/home.php');
            exit;
        }
    } 