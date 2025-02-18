<?php
include 'includes/header.php';
include './includes/config.php';
?>
<html style="height: 100%">
    <body style="background: url(/project/Images_zoo/ai-generated-8201419_1920.png) no-repeat; height: 100%">
    <form class="login-form" method='post' action='controllers/AuthController.php'>
        <label for='username'>Nom utilisateur</label>
        <input type='text' id='username' name='username'/>
        <label for='password'>Mot de passe</label>
        <input type='password' id='password' name='password'/>
        <input type='submit' value='validez'/>
    </form>
    </body>
</html>
