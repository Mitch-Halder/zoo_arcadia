<?php
    require_once '../animalController.php';
    /*session_start();*/
    /*include './includes/config.php';*/
    $animal=new AnimalController();
    if (isset($_GET['action'])){
        $action=$_GET['action'];
        switch ($action){
            case 'delete':
                if (isset($_GET['id'])){
                    $animal->delete($_GET['id']);
                    header('Location: animal.php');
                }
                break;
                case 'update':
                    if (isset($_GET['id'])) {
                        $idToUpdate = intval($_GET['id']);
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $prenom = $_POST['prenom'];
                            if (!isset($_POST['images_animal'])){
                                $images_animal='{}';
                            } else {
                                $images_animal = $_POST['images_animal'];
                            }
                            $etat = $_POST['etat'];
                            $animal->update($idToUpdate, $prenom, $etat, $images_animal);
                            header('Location: animal.php');
                            exit;
                        } 
                        else {
                            $animals = $animal->read();
                            $animalToEdit = null;
                            foreach ($animals as $animal) {
                                if ($animal['animal_id'] == $idToUpdate) {
                                    $animalToEdit = $animal;
                                    break;
                                }
                            }
                        }
                    }
                                    break;
        }
    }
    if (!isset($animals)){
    $animals=$animal->read();
    }    
    ?>

    <ul>

    <?php foreach ($animals as $h):?>

<li>
            <div class="card">
                <?php
                    $imageLinks=$h['images_animal'];
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
                            <?php echo htmlspecialchars($h['prenom']);?>
                            <a href="/project/admin/animal.php?action=delete&id=<?php echo htmlspecialchars($h['animal_id'])?>">
                                <button>supprimer animal</button></a>
                            <a href="/project/admin/animal.php?action=update&id=<?php echo htmlspecialchars($h['animal_id'])?>">
                                <button>modifier animal</button></a>
                </div>
                <?php if (isset($animalToEdit)&& $h['animal_id']== $animalToEdit['animal_id']): ?>
        
        <h2>Modifier l'Animal</h2>
    <form action="animal.php?action=update&id=<?php echo htmlspecialchars($animalToEdit['animal_id']); ?>" method="POST">
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($animalToEdit['prenom']); ?>" required>
        <textarea name="etat" required>
        <?php echo htmlspecialchars($animalToEdit['etat']); ?></textarea>
        <button type="submit">Mettre à jour</button>
    </form>

    <?php endif; ?>

        </li>
        <?php endforeach;?>
        </ul>
        

        
    