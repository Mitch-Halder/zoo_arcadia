<?php
    session_start();
    include './includes/config.php';
    /*if (!isset($_SESSION['user']))
    {
        header('Location: login.php');
        exit();
    }*/
    $query=$pdo->query('SELECT * FROM habitat');
    $habitats=$query->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <style>
            img{
                width: 50px;
                height: 50px;
            }
        </style>
    </head>
    <p>
        habitats
    </p>
    <ul>
        <?php foreach ($habitats as $row) :?>
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
                            aucune image disponible pour cet habitat
                        </p>
                        <?php endif;?>
                            <?php echo htmlspecialchars($row['nom']);?>
                            <a href="/project/habitat.php?id=<?php echo htmlspecialchars($row['habitat_id'])?>">
                                <button>Voir habitat</button></a>
                </div>
        </li>
        <?php endforeach;?>
    </ul>
</html>