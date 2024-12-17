<?php
    include 'includes/header.php';
    require 'avisController.php';
    $avisController = new AvisController();
    //print_r($avisController->getAllAvis()); 
    if (isset($_GET['action'])){
        $action=$_GET['action'];
        switch ($action){
            case 'delete':
                if (isset($_GET['id'])){
                    $animal->delete($_GET['id']);
                    header('Location: animal.php');
                }
                break;
                case 'create':
                    $commentaire=$_POST['commentaire'] ? $_POST['commentaire']:'';
                    $user=$_SESSION['user'] ? $_SESSION['user']:'';
                    $avisController->createAvis($user, $commentaire);
                                    break;
        }
    }
    ?>
    <form class="avis-form" action="avis.php?action=create" method="POST">

            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" id="commentaire" cols="50" rows="10"></textarea>
            
    <!--</select>-->
        <button class="btn" type="submit">Soumettre</button>
    </form>