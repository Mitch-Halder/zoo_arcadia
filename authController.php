<?php
    session_start();
    include './includes/config.php';
    if ($_SERVER['REQUEST_METHOD']=='POST')
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $query=$pdo->prepare('SELECT * FROM users WHERE username= :username AND password= :password');
        $query->execute(['username'=>$username, 'password'=>$password]);
        if($query->rowCount()>0)
        {
            $_SESSION['user']=$username;
            header('Location: home.php');
            exit();
        }
        else
        {
            echo'identifiant incorrect';
        }
    }
?>