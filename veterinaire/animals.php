<?php
    include '../includes/header.php';
    require_once '../includes/guard.php';
    require_once '../controllers/AnimalController.php';
    require_once '../controllers/AlimentationController.php';
    /*include './includes/config.php';*/
    //checkAccess(['veterinaire']);
    $animalController=new AnimalController();
    $animals=$animalController->readOrderByName();
?>

<html>
    
    <body>

        <div class="card-list">

            <?php foreach ($animals as $row) :?>
                <a href="/project/veterinaire/animalAlimentation.php?id=<?php echo htmlspecialchars($row['animal_id']);?>">
                                  
                <div class="card">

                    <?php
                        $imageLinks=$row['images_animal'];
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

                            <img class="image_gallery" src="/project/<?php echo htmlspecialchars($imageLink);?>" alt="">

                                <?php endforeach;?>
                    
                                    <?php else: ?>

                                        <p>
                                            aucune image disponible pour cet animal
                                        </p>

                        <?php endif;?>

                            <p class="animal-name"><?php echo htmlspecialchars($row['prenom']);?></p>

                                

                </div>
                                    </a>

                    <?php endforeach;?>

        </div>

    </body>
    
</html>