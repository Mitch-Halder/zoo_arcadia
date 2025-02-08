<?php
    $idAnimal=$_GET['id'];
    print_r($idAnimal); 
    include '../includes/header.php';
    require_once '../rapportController.php';
    require_once '../animalController.php';

    $animal=new AnimalController();
    $rapportController=new RapportController($animal->getPdo());   
    $rapports=$rapportController->getRapportByAnimalId($idAnimal);
    ?>
    <div class="dashboard">
    <?php
    $imageLinks=$rapports[0]['images_animal'];
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
         <p>Prénom : <?php echo htmlspecialchars($rapports[0]['prenom']);?></p>           
<?php endforeach; endif;?>
    <?php
    foreach ($rapports as $rapport):?>
        <div class="action">
            <p>Date : <?php echo htmlspecialchars($rapport['date']);?></p>
            <p>Détails : <?php echo htmlspecialchars($rapport['detail']);?></p>
            <p>Auteur : <?php echo htmlspecialchars($rapport['user_id']);?></p>
            </div>
    
<?php
print_r($rapports);
endforeach;
?>
</div>