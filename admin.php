<?php
include 'includes/header.php';
include './includes/config.php';
?>

<html>
    <body>
        <div class="dashboard">
            <h1 style="text-align:center">Tableau de bord</h1>
            <a href="/project/admin/user.php"><div class="action">
                <h4>gestion utilisateurs</h4>
            </div></a>
            <a href="/project/admin/animal.php"><div class="action">
                <h4>gestion animaux</h4>
            </div></a>
            <a href="/project/admin/services.php"><div class="action">
                <h4>gestion services</h4>
            </div></a>
            <a href="/project/admin/horaires.php"><div class="action">
            <h4>gestion horaires</h4>
        </div></a>
        <a href="/project/admin/habitat.php"><div class="action">
                <h4>gestion habitats</h4>
            </div></a>
            <div class="action">
                <h4>consultation rapports</h4>
            </div>
            <div class="action">
                <h4>Statistiques</h4>
            </div>
        </div>
    </body>
</html>