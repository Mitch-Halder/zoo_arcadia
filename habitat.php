<?php
    session_start();
    include './includes/config.php';
    /*if (!isset($_SESSION['user']))
    {
        header('Location: login.php');
        exit();
    }*/
    $idHabitat=$_GET['id'];
    $query=$pdo->prepare('SELECT * FROM habitat JOIN animal ON habitat.habitat_id=animal.habitat_id WHERE habitat.habitat_id=?');
    $query->execute([$idHabitat]);
    $habitat=$query->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <style>

        </style>
    </head>
    <?php foreach ($habitat as $row) :?>
        <li>
            <div class="card">
                <?php
                    $imageLinks=$row['images'];
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
                            <a href="/project/animal.php?id=<?php echo htmlspecialchars($row['animal_id'])?>">
                                <button>Voir animal</button></a>
                </div>
        </li>
        <?php endforeach;?>
</html>