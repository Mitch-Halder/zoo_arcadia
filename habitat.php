<?php
    //include './includes/config.php';
    include 'includes/header.php';
    require_once './controllers/HabitatController.php';
    
    $idHabitat=$_GET['id'];
    $habitatController=new HabitatController();
    $habitat=$habitatController->getAnimalsByHabitat($idHabitat);
?>

<html>
    
    <body>

        <div class="card-list">

            <?php foreach ($habitat as $row) :?>
                <a href="/project/animal.php?id=<?php echo htmlspecialchars($row['animal_id']);?>">
                                  
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