<?php
session_start();
session_destroy();
//$redirect=isset($_SESSION['redirect']) ? $_SESSION['redirect']:'/home.php';
$redirect='home.php';
header("Location: home.php");
exit();
?>
