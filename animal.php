<?php
    session_start();
    include './includes/config.php';
    /*if (!isset($_SESSION['user']))
    {
        header('Location: login.php');
        exit();
    }*/
    $idAnimal=$_GET['id'];
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