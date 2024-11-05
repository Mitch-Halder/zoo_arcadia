<?php
    require_once '../habitatController.php';
    /*session_start();*/
    /*include './includes/config.php';*/
    $habitat=new HabitatController();
    if (isset($_GET['action'])){
        $action=$_GET['action'];
        switch ($action){
            case 'delete':
                if (isset($_GET['id'])){
                    $habitat->delete($_GET['id']);
                    header('Location: habitat.php');
                }
                break;
                case 'update':
                    if (isset($_GET['id'])) {
                        $idToUpdate = intval($_GET['id']);
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $nom = $_POST['nom'];
                            if (!isset($_POST['images'])){
                                $images='{}';
                            } else {
                                $images = $_POST['images'];
                            }
                            $description = $_POST['description'];
                            $habitat->update($idToUpdate, $nom, $description, $images);
                            header('Location: habitat.php');
                            exit;
                        } 
                        else {
                            $habitats = $habitat->read();
                            $habitatToEdit = null;
                            foreach ($habitats as $habitat) {
                                if ($habitat['habitat_id'] == $idToUpdate) {
                                    $habitatToEdit = $habitat;
                                    break;
                                }
                            }
                        }
                    }
                                    break;
        }
    }
    if (!isset($habitats)){
    $habitats=$habitat->read();
    }    
    ?>

    <ul>

    <?php foreach ($habitats as $h):?>

<li>
            <div class="card">
                <?php
                    $imageLinks=$h['images'];
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
                            <?php echo htmlspecialchars($h['nom']);?>
                            <a href="/project/admin/habitat.php?action=delete&id=<?php echo htmlspecialchars($h['habitat_id'])?>">
                                <button>supprimer habitat</button></a>
                            <a href="/project/admin/habitat.php?action=update&id=<?php echo htmlspecialchars($h['habitat_id'])?>">
                                <button>modifier habitat</button></a>
                </div>
        </li>
        <?php endforeach;?>
        </ul>
        <?php if (isset($habitatToEdit)): ?>
        
            <h2>Modifier l'Habitat</h2>
        <form action="habitat.php?action=update&id=<?php echo htmlspecialchars($habitatToEdit['habitat_id']); ?>" method="POST">
            <input type="text" name="nom" value="<?php echo htmlspecialchars($habitatToEdit['nom']); ?>" required>
            <textarea name="description" required>
            <?php echo htmlspecialchars($habitatToEdit['description']); ?></textarea>
            <button type="submit">Mettre à jour</button>
        </form>

        <?php endif; ?>

        
    