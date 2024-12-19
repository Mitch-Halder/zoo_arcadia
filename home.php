<?php
    require 'vendor/autoload.php';
    require_once './avisController.php';
    include 'includes/header.php';
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

    <section class="accueil" id="accueil">  

        <div class="content">
            <h3>Profitez de la merveilleuse<br>
                aventure des animaux</h3>
                <a href="#footer" class="btn">Rencontrez-nous</a>
        </div>

    </section>

    <section class="a_propos" id="a_propos">
            <h2 class="deco-title">A propos de nous</h2>
                <div class="box-container">
                    <div class="image">
                        <img src="/project/Images_zoo/caméléon1.jpg" alt="">
                    </div>

                <div class="content">
                    <h3 class="title">vous pouvez trouver les espèces les plus populaires</h3>
                        <p>ARCADIA est situé près de la forêt de Brocéliande en Bretagne depuis 1960. Notre zoo possède toute un pléiade d'animaux de toutes espèces.<br>
                            venez découvrir ces animaux et leurs habitats naturels dans un parc boisé. le zoo est énergiquement indépendant de par son installation de panneaux photovoltaïques.</p>
                            <div class="icons-container">
                                <div class="icons">
                                    <i class="fas fa-graduation-cap"></i>
                                        <h3>Nous élevons</h3>
                                </div>

                                <div class="icons">
                                    <i class="fas fa-bullhorn"></i>
                                        <h3>Nous jouons</h3>
                                </div>

                                <div class="icons">
                                    <i class="fas fa-book-open"></i>
                                        <h3>Apprenons à connaître</h3>
                                </div>
                            </div>
                </div>
    </section>

    <section class="gallery" id="gallery">
        <h2 class="heading">galerie</h2>
            <div class="slider">
                <div class="slides">
                    <div class="slide">
                            <img src="Images_zoo/Jungle/chimpanze.jpg" alt="chimpanzé">
                    </div>

                    <div class="slide">
                        <img src="Images_zoo/Jungle/panthere_noire.jpg" alt="Pantère_noire">
                    </div>

                    <div class="slide">
                        <img src="Images_zoo/Jungle/macaque.jpg" alt="macaque">
                    </div>

                    <div class="slide">
                        <img src="Images_zoo/Serpents/mamba_noir.jpg" alt="mamba_noir">
                    </div>
                </div>
            </div>
    </section>
        
    <section class="habitats" id="habitats">
        <h2 class="heading">
        habitats
        </h2>
            <div class="box-container">

                <?php foreach ($habitats as $row) :?>
        
            <div class="box">

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

                    <div class="content">

                        <h3><?php echo htmlspecialchars($row['nom']);?></h3>
                            <a class='btn' href="/project/habitat.php?id=<?php echo htmlspecialchars($row['habitat_id'])?>">
                                Voir détails</a>
                    </div>
            </div>
        
        <?php endforeach;?>
    
    </div>
</section>

    <?php $client = new MongoDB\Client("mongodb://localhost:27017"); 
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
    ?>
    
    <section class="services" id="services">
        <h2 class="heading">services</h2>
            <div class="box-container">

    <?php foreach($resultArray as $service): ?>
            <div class="box" id="<?php
                            echo htmlspecialchars($service['Name']);
                    ?>">
                <img src="<?php 
                    echo htmlspecialchars($service['image']);
                    ?>">
                    <div class="content">
                        <h3><?php
                            echo htmlspecialchars($service['Name']);
                    ?>
                        </h3>
                    </div>
            </div>
        <?php endforeach; ?>
        </div>
        </section>
        
        <section class="banniere">
            <div class="row">
                <div class="content">
                    <h3>Restez avec nos animaux</h3>
                        <p>Passez une ou plusieurs nuits dans l'un de nos gîtes au plus près de nos animaux afin de vivre une expérience immersive dans leur quotidien.</p>
                </div>

                <div class="image">
                    <img src="Images_zoo/Jungle/perroquet orange.jpg" alt="">
                </div>

                <div class="image2">
                    <img src="Images_zoo/services/gite_panneau_solaire.jpg" alt="gite">
                </div>

            </div>

        </section>
        <section class="tarifs" id="tarifs">

            <h2 class="heading">Tarifs</h2>

                <div class="box-container">
                    <div class="box">
                        <img src="Images_zoo/individuel.png" alt="">
                            <h3>Individuels</h3>
                                <h4 class="prix">20€</h4>
                                    <p>Entrée de 08:30 à 16:45</p>
                    </div>

                <div class="box">
                    <img src="Images_zoo/etudiant.png" alt="">
                        <h3>Etudiants</h3>
                            <h4 class="prix">12€</h4>
                                <p>Entrée de 08:30 à 16:45</p>
                </div>

                <div class="box">
                    <img src="Images_zoo/famille.jpg" alt="">
                        <h3>Famille</h3>
                            <h4 class="prix">30€</h4>
                                <p>Entrée de 08:30 à 16:45</p>
                </div>

            </div>

        </section>
        <section class="contact" id="contact">

                <h2 class="heading">Contact</h2>

                <form action="">

                    <div class="inputbox">
                        <input type="text" placeholder="nom">
                        <input type="text" placeholder="email">
                    </div>

                    <div class="inputbox">
                        <input type="phone_number" placeholder="téléphone">
                        <input type="text" placeholder="sujet">
                    </div>

                        <textarea name="" id="" cols="30" rows="10" placeholder="message"></textarea>
                            <a href="#" class="btn">Envoyer</a>

                </form>

            </section>

            <section class="avis">

            <h2 class="heading">
                Avis visiteurs
            </h2>

            
                <div class="avis-list">
                    <?php
                    $avisController = new AvisController();
                    $allAvis = $avisController->getAllAvis();
                    $allAvis = $avisController->buildArrayFromIterable($allAvis);
                    foreach($allAvis as $avis) : 
                        if ($avis['isVisible']) : ?>

                    
                        <div class="avis-container">
                    <h4 style='font-style : italic'><?php echo htmlspecialchars ($avis['pseudo']); ?></h4>
                    <p><?php echo htmlspecialchars ($avis['commentaire'])?></p>
                    </div>
                    
                        <?php endif; 
                    endforeach; ?>
                </div>
            

            </section>
        
    </html>
