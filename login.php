<?php
include './includes/config.php';
?>
<html>
    <form method='post' action='authController.php'>
        <label for='username'>Nom utilisateur</label>
        <input type='text' id='username' name='username'/>
        <label for='password'>Mot de passe</label>
        <input type='password' id='password' name='password'/>
        <input type='submit' value='validez'/>
    </form>
</html>
