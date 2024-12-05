<?php
    require 'vendor/autoload.php';
    session_start();
    include './includes/config.php';
    /*if (!isset($_SESSION['user']))
    {
        header('Location: login.php');
        exit();
    }*/
    $idAnimal=$_GET['id'];
    $client = new MongoDB\Client("mongodb://localhost:27017"); 
    $database = $client->selectDatabase('ARCADIA'); 
    $collection = $database->selectCollection('Statistiques');
    
    function incrementScore($collection, $animal_id) {
        $updateResult = $collection->updateOne(
            ['animal_id' => $animal_id], 
            ['$inc' => ['score' => 1]] 
        );
    
        if ($updateResult->getMatchedCount() > 0) {
            echo "Document with animal_id=$animal_id updated: score incremented." . PHP_EOL;
        } else {
    $insertResult = $collection->insertOne([
                'animal_id' => $animal_id,
                'score' => 1
            ]);
            echo "New document created with ID: " . $insertResult->getInsertedId() . PHP_EOL;
        }
    
        return $collection->findOne(['animal_id' => $animal_id]);
    }

    $result=incrementScore($collection, $idAnimal);
    print_r($result);

    $query=$pdo->prepare('SELECT * FROM animal JOIN race ON animal.race_id=race.race_id JOIN habitat ON animal.habitat_id=habitat.habitat_id WHERE animal.animal_id=?');
    $query->execute([$idAnimal]);
    $animal=$query->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <style>

        </style>
    </head>
    <?php foreach ($animal as $row) :?>
        <li>
            <div class="card">
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
                            <img src="/project/<?php echo htmlspecialchars($imageLink);?>" alt="">
                        <?php endforeach;?>
                    </div>
                    <?php else: ?>
                        <p>
                            aucune image disponible pour cet animal
                        </p>
                        <?php endif;?>
                            <?php echo htmlspecialchars($row['prenom']);?>
                            <?php echo htmlspecialchars($row['etat']);?>
                            <?php echo htmlspecialchars($row['label']);?>
                            <?php echo htmlspecialchars($row['nom']);?>
                </div>
        </li>
        <?php endforeach;?>
</html>