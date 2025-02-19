<?php
    //require 'vendor/autoload.php';
    include 'includes/header.php';
    include 'includes/config.php';
    require_once 'controllers/AnimalController.php';
    /*if (!isset($_SESSION['user']))
    {
        header('Location: login.php');
        exit();
    }*/
    $idAnimal=$_GET['id'];
    $client = new MongoDB\Client("mongodb+srv://Jean-Michel:Pitchoune131005@cluster0.4ljrt.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0"); 
    $database = $client->selectDatabase('ARCADIA'); 
    $collection = $database->selectCollection('Statistiques');
    
    function incrementScore($collection, $animal_id) {
        $updateResult = $collection->updateOne(
            ['animal_id' => $animal_id], 
            ['$inc' => ['score' => 1]] 
        );
    
        if ($updateResult->getMatchedCount() > 0) {
        } else {
    $insertResult = $collection->insertOne([
                'animal_id' => $animal_id,
                'score' => 1
            ]);
        }
    
        return $collection->findOne(['animal_id' => $animal_id]);
    }
    if (!$_SESSION || !$_SESSION['user']){
        $result=incrementScore($collection, $idAnimal);
    }
    $animalController=new AnimalController();
    $animal=$animalController->getAnimalById($idAnimal)
?>

<html style="height:100%; overflow:hidden">
    <body style="height:100%">
        
    
<div class="container">
    <?php foreach ($animal as $row) :?>

        

            <div class="card-animal">
                
                <?php
                    $imageLinks=$row['images_animal'];
                        if ($imageLinks){
                            $imageLinks=trim($imageLinks,'{}');
                            $imageArray=explode(',', $imageLinks);
                            $imageArray = array_map(function($item) {
                                return str_replace("'", "", $item);
                            }, $imageArray);
                        }
                ?>

                <?php if (!empty($imageArray)):?>

                    <div class="image-gallery">

                        <?php foreach($imageArray as $imageLink):?>

                            <img class="img-details" src="/<?php echo htmlspecialchars($imageLink);?>" alt="">

                        <?php endforeach;?>

                    </div>

                    <?php else: ?>

                        <p>
                            aucune image disponible pour cet animal
                        </p>

                        <?php endif;?>

                            <h4>Prénom</h4><?php echo htmlspecialchars($row['prenom']);?>
                            <h4>Etat</h4><?php echo htmlspecialchars($row['etat']);?>
                            <h4>Race</h4><?php echo htmlspecialchars($row['label']);?>
                            

            </div>

        
        
    <?php endforeach;?>
    </div>
    </body>
</html>