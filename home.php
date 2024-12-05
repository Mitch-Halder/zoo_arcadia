<?php
    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://localhost:27017"); 
    $database = $client->selectDatabase('ARCADIA'); 
    $collection = $database->selectCollection('Services');
    
    $result = $collection->find();
    function buildArrayFromIterable($iterable) {
        $result = [];
    
        foreach ($iterable as $element) {
            $result[] = (array) $element;
        }
    
        return $result;
    }
    $resultArray=buildArrayFromIterable($result);
    
    foreach($resultArray as $service):
        print_r($service['Name']);
        ?>
            <div class="box" id="churros">
                <img src="Images_zoo/services/churros-2188871_1920.jpg" alt="churros">
                    <div class="content">
                        <h3><?php
                            echo htmlspecialchars($service['Name']);
                    ?>
                        </h3>
                    </div>
            </div>
        <?php endforeach;
    /*foreach ($result as $entry) {
        echo '<pre>';
        print_r((array) $entry);
        echo '</pre>';
    }*/
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
                width: 100px;
                height: 100px;
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