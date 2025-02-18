<?php
    session_start();
    require_once __DIR__ . '/../includes/Database.php';
    include '../includes/config.php';
    if ($_SERVER['REQUEST_METHOD']=='POST')
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $pdo=Database::getInstance();
        $query=$pdo->prepare('SELECT * FROM users WHERE username= :username');
        $query->execute(['username'=>$username]);
        $result=$query->fetch(PDO::FETCH_ASSOC);
        if($query->rowCount()>0 && password_verify($password, $result['password']))
        {
            $result=array_diff_key($result, array('password'=>true));
            $_SESSION['user']=$result;
            unset($_SESSION['user']['password']);
            header('Location: ../home.php');
            exit();
        }
        else
        {
            echo'identifiant incorrect';
        }
    }
?>