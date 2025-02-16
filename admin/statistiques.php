<?php
    include '../includes/header.php';
    require_once '../controllers/StatistiquesController.php';
    require_once '../controllers/AnimalController.php';

    $statistiquesController=new StatistiquesController();
    $statistiques=$statistiquesController->getAllStatistiques();
    $animalController=new AnimalController();
        ?>
        <div class="main-container">
        <h2 style="text-align:center;">Statistiques</h2>
        <div class="card-list">
            <?php
    foreach($statistiques as $statistique){
        $animal=$animalController->getAnimalById($statistique['animal_id'])[0];?>
                <div class="card" style="font-size:large;">

<?php
    $imageLinks=$animal['images_animal'];
    if ($imageLinks){
        $imageLinks=trim($imageLinks,'{}');
        $imageArray=explode(',', $imageLinks);
        $imageArray = array_map(function($item) {
            return str_replace("'", "", $item);
        }, $imageArray);
    $imageArray = array_map(function($item) {
        return str_replace('"', "", $item);
    }, $imageArray);
}
?>

<?php if (!empty($imageArray)):?>


<?php foreach($imageArray as $imageLink):?>

    <img class="img-details" src="/project/<?php echo htmlspecialchars($imageLink);?>" alt="">
                    
<?php endforeach;?>

                
<?php else: ?>
                    
<?php endif;?>
                        
<h4><?php echo htmlspecialchars($animal['prenom']);?></h4>
            <p>Score : <?php echo htmlspecialchars($statistique['score']);?></p>
</div>
<?php
    }
    ?>
    </div>
    </div>