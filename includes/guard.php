<?php
    function getNameByRoleIdGuard(){
        switch ($_SESSION['user']['role_id']) {
            case 1:
                return 'admin';
                break;
            case 2:
                return 'employe';
                break;
            case 3:
                return 'veterinaire';
                break;
            
            default:
                # code...
                break;
        }
    }

    function checkAccess($allowedRoles) {
        if (!isset($_SESSION['user'])){
            header('Location:login.php');
            exit;
        }
        $userRole=getNameByRoleIdGuard();
        if (!in_array($userRole, $allowedRoles)){
            header('Location:/project/home.php');
            exit;
        }
    } 