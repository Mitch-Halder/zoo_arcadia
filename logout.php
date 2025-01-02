<?php
session_start();
session_destroy();
$redirect=isset($_SESSION['redirect']) ? $_SESSION['redirect']:'/project/home.php';
print_r($redirect);
unset($_SESSION['redirect']);
header("Location: {$redirect}");
exit();
?>