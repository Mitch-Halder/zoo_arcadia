<?php
include 'includes/header.php';
include './includes/config.php';
?>

<html>
    <body>
        <div class="dashboard">
            <h1 style="text-align:center">Tableau de bord</h1>
            <a href="/admin/user.php"><div class="action">
                <h4>gestion utilisateurs</h4>
            </div></a>
            <a href="/admin/animal.php"><div class="action">
                <h4>gestion animaux</h4>
            </div></a>
            <a href="/admin/services.php"><div class="action">
                <h4>gestion services</h4>
            </div></a>
            <a href="/admin/horaires.php"><div class="action">
            <h4>gestion horaires</h4>
        </div></a>
        <a href="/admin/habitat.php"><div class="action">
                <h4>gestion habitats</h4>
            </div></a>
            <a href="/admin/rapportVeterinaire.php"><div class="action">
                <h4>consultation rapports</h4>
            </div></a>
            <a href="/admin/statistiques.php"><div class="action">
                <h4>Statistiques</h4>
            </div></a>
        </div>
    </body>
</html>