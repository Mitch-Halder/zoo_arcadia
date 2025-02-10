<?php
    include '../includes/header.php';
    require_once '../rapportController.php';
    require_once '../animalController.php';

    $animal=new AnimalController();
    $rapportController=new RapportController($animal->getPdo());   
    $allRapports=$rapportController->read();
    $animalSelected="";
    $dateSelected="";
if(isset($_POST["animal"])){
       $animalSelected=$_POST["animal"];
   }
if(isset($_POST["date"])){
       $dateSelected=$_POST["date"];
   }
    $uniqueNames = [];

foreach ($allRapports as $entry) {
    if (!isset($uniqueNames[$entry['prenom']])) {
        $uniqueNames[$entry['prenom']] = [
            'id' => $entry['animal_id'],
            'prenom' => $entry['prenom']
        ];
    }
}

    $uniqueNames = array_values($uniqueNames);
    $uniqueDates = array_unique(array_column($allRapports, 'date'));
    $selectedAnimalId = $_POST['animal'] ?? '';
    $selectedDate = $_POST['date'] ?? '';
    ?>
    <form class="filter-form" method="POST" action="">
    <p>Selectionner un animal</p>
    <select name="animal">
        <option value="" <?php echo empty($selectedAnimalId) ? 'selected' : ''; ?>>--select--</option>
       <?php foreach($uniqueNames as $name): ?> 
        <option value="<?php echo htmlspecialchars($name["id"]);?>"<?php echo ($animalSelected == $name['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($name["prenom"]);?></option>
        <?php endforeach;?>
    </select>

    <p>Selectionner une date</p>
    <select name="date">
        <option value="" <?php echo empty($selectedDate) ? 'selected' : ''; ?>>--select--</option>
       <?php foreach($uniqueDates as $date): ?> 
        <option value="<?php echo htmlspecialchars($date);?>"<?php echo ($dateSelected == $date) ? 'selected' : ''; ?>><?php echo htmlspecialchars($date);?></option>
        <?php endforeach;?>
    </select>
    <button class="btn-blue" type="submit">Filtrer</button>
</form>
    <div class="card-list">
    <?php   
        foreach($allRapports as $rapport):
            if (($animalSelected == "" || $rapport['animal_id'] == $animalSelected) && ($dateSelected == "" || $rapport['date'] == $dateSelected)):
        ?>

            <a href="/project/admin/rapportVeterinaireDetails.php?id=<?php echo htmlspecialchars($rapport['animal_id'])?>"> 
                <div class="card" style="font-size:large;">

<?php
    $imageLinks=$rapport['images_animal'];
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
                        
<h4><?php echo htmlspecialchars($rapport['prenom']);?></h4>
            <p>Date : <?php echo htmlspecialchars($rapport['date']);?></p>
            <p>Détails : <?php echo htmlspecialchars($rapport['detail']);?></p>
            <p>Auteur : <?php echo htmlspecialchars($rapport['user_id']);?></p>
</div></a>
<?php endif; endforeach;?>
    </div>