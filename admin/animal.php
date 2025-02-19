<?php
    include '../includes/header.php';
    require_once '../controllers/AnimalController.php';
    $animal_create=false;
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
                                    case 'create':
                                        if (isset($_GET['complete'])){
                                            $animal_create=false;
                                            $race= $_POST['races'];
                                            $habitat= $_POST['habitats'];
                                            $images_animal=[];
                                                $prenom = $_POST['prenom'];
                                                $animal->create($prenom, $race, $habitat, $images_animal);
                                            /*header('Location: animal.php');*/
                                        }
                                        else {
                                            $animal_create=true;
                                        }
                                        break;
        }
                }
                if (!isset($animals)){
                $animals=$animal->read();
                $races=$animal->getRaces();
                $habitats=$animal->getHabitats();
                }  
                //$races=[];  
                //$habitats=[];
?>
<a href="/admin/animal.php?action=create">
        <button class="btn">Créer animal</button></a>

        <?php if ($animal_create): ?>
        
    <form class="create-animal-form" action="admin/animal.php?action=create&complete=true" method="POST" enctype="multipart/form-data">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" value="" required>
        <label for="race">Race</label>
        <select name="races" id="races">
            <?php foreach ($races as $race):?>
                <option value="<?php echo htmlspecialchars($race['race_id'])?>"><?php echo htmlspecialchars($race['label'])?></option>
                <?php endforeach; ?>
        </select>
        <label for="habitat">Habitat</label>
        <select name="habitats" id="habitats">
            <?php foreach ($habitats as $habitat):?>
                <option value="<?php echo htmlspecialchars($habitat['habitat_id'])?>"><?php echo htmlspecialchars($habitat['nom'])?></option>
                <?php endforeach; ?>
        </select>
        <input type="file" name="image" required>
        <button class="btn" type="submit">Créer</button>
    </form>
    <?php endif; ?>

<div class="card-list">
    <?php foreach ($animals as $h):?>
       
            <div class="card">

    <?php
        $imageLinks=$h['images_animal'];
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

        <img class="image_gallery" src="/<?php echo htmlspecialchars($imageLink);?>" alt="">
                        
    <?php endforeach;?>

                    
    <?php else: ?>
                        
    <?php endif;?>
                            
    <h4 style="text-align: center; font-size: medium;">
    
    <?php echo htmlspecialchars($h['prenom']);?></h4>

    <div>
        <a href="/admin/animal.php?action=delete&id=<?php echo htmlspecialchars($h['animal_id'])?>">

            <button class="btn-red-sm">supprimer</button></a>

                <a href="/admin/animal.php?action=update&id=<?php echo htmlspecialchars($h['animal_id'])?>">

                    <button class="btn-blue-sm">modifier</button></a>

    <?php if (isset($animalToEdit)&& $h['animal_id']== $animalToEdit['animal_id']): ?>
        
        <h2>Modifier l'Animal</h2>
    
            <form action="/admin/animal.php?action=update&id=<?php echo htmlspecialchars($animalToEdit['animal_id']); ?>" method="POST">

                <input type="text" name="prenom" value="<?php echo htmlspecialchars($animalToEdit['prenom']); ?>" required>

                    <textarea name="etat" required>

    <?php echo htmlspecialchars($animalToEdit['etat']); ?></textarea>
        
        <button type="submit">Mettre à jour</button>
        
            </form>

    <?php endif; ?>

    </div>
    </div>

    <?php endforeach;?>

    </div>