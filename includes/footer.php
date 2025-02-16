<?php
    include_once __DIR__.'/../controllers/ServicesController.php';
    $servicesController = new ServicesController();
    $horaires=$servicesController->getHoraire();
?>

<footer>
    <div class="contenu-footer">
        <div class="footer-horaires" id="horaires">
            <h3>Horaires</h3>
            <?php
                echo nl2br(htmlspecialchars($horaires['Description']));
            ?>
        </div>
    </div>
</footer>