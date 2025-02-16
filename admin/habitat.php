<?php
    include '../includes/header.php';
    require_once '../controllers/HabitatController.php';
    $habitat_create=false;
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
                            if (!isset($_POST['images_habitat'])){
                                $images_habitat='{}';
                            } else {
                                $images_habitat = $_POST['images_habitat'];
                            }
                            $description = $_POST['description'];
                            $habitat->update($idToUpdate, $nom, $description, $images_habitat);
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
                                    case 'create':
                                        if (isset($_GET['complete'])){
                                            $habitat_create=false;
                                            $description= $_POST['description'];
                                            $images_habitat=[];
                                                $nom = $_POST['nom'];
                                                $habitat->create($nom, $description, $images_habitat);
                                            /*header('Location: habitat.php');*/
                                        }
                                        else {
                                            $habitat_create=true;
                                        }
                                        break;
        }
                }
                if (!isset($habitats)){
                    $habitats=$habitat->read();
                    }  
?>
<a href="/project/admin/habitat.php?action=create">
        <button class="btn">Créer habitat</button></a>

        <?php if ($habitat_create): ?>
        
    <form class="basic-form" action="admin/habitat.php?action=create&complete=true" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom habitat</label>
        <input type="text" name="nom" value="" required>
        <label for="image">Image</label>
        <input type="file" name="image" required>
        <label for="description">Description</label>
        <textarea name="description" required></textarea>
        <button class="btn" type="submit">Créer</button>
    </form>
    <?php endif; ?>

<div class="card-list">
    <?php foreach ($habitats as $h):?>
       
            <div class="card">

    <?php
        $imageLinks=$h['images'];
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
                        
    <?php endif;?>
                            
    <h4 style="text-align: center; font-size: medium;">
    
    <?php echo htmlspecialchars($h['nom']);?></h4>

    <div class="action-buttons">
        <a href="/project/admin/habitat.php?action=delete&id=<?php echo htmlspecialchars($h['habitat_id'])?>">

            <button class="btn-red-sm">supprimer</button></a>

                <a href="/project/admin/habitat.php?action=update&id=<?php echo htmlspecialchars($h['habitat_id'])?>">

                    <button class="btn-blue-sm">modifier</button></a>

    <?php if (isset($habitatToEdit)&& $h['habitat_id']== $habitatToEdit['habitat_id']): ?>
        
        <h2>Modifier l'Habitat</h2>
    
            <form action="habitat.php?action=update&id=<?php echo htmlspecialchars($habitatToEdit['habitat_id']); ?>" method="POST">

                <input type="text" name="nom" value="<?php echo htmlspecialchars($habitatToEdit['nom']); ?>" required>

                    <textarea name="description" required>

    <?php echo htmlspecialchars($habitatToEdit['description']); ?></textarea>
        
        <button type="submit">Mettre à jour</button>
        
            </form>

    <?php endif; ?>

    </div>
    </div>

    <?php endforeach;?>

    </div>