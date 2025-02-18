<?php
    $idAnimal=$_GET['id'];
    include '../includes/header.php';
    require_once '../controllers/AlimentationController.php';
    require_once '../controllers/AnimalController.php';

    $animal=new AnimalController();
    $alimentationController=new AlimentationController();   
    $alimentations=$alimentationController->getAlimentationByAnimalId($idAnimal);
    if (count($alimentations)>0):
    ?>
    <div class="dashboard">
    <?php
    $imageLinks=$alimentations[0]['images_animal'];
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
         <p>Prénom : <?php echo htmlspecialchars($alimentations[0]['prenom']);?></p>           
<?php endforeach; endif;?>
    <?php
    foreach ($alimentations as $alimentation):?>
        <div class="action">
            <p>Date : <?php echo htmlspecialchars($alimentation['date']);?></p>
            <p>Détails : <?php echo htmlspecialchars($alimentation['detail']);?></p>
            <p>Auteur : <?php echo htmlspecialchars($alimentation['user_id']);?></p>
            </div>
    
<?php
endforeach;
else:
    echo 'pas de données pour cet animal';
endif;
?>
</div>