<?php
    include '../includes/header.php';
    require '../controllers/ServicesController.php';
    $servicesController = new ServicesController();
    $allServices = $servicesController->getAllServices(); 
    $service_create=false;
        if (isset($_GET['action'])){
    $action=$_GET['action'];
        switch ($action){
            case 'delete':
        if (isset($_GET['id'])){
                $servicesController->delete($_GET['id']);
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        break;
        case 'update':
            if (isset($_GET['id'])) {
                $idToUpdate = $_GET['id'];
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $name= $_POST['name'];
                                    $description= $_POST['description'];
                                    $images_services=[];
                    $servicesController->update($idToUpdate, $name, $description, $images_services);
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                } 
                else {
                    $services = $servicesController->getAllServices();
                    $serviceToEdit = null;
                    foreach ($services as $service) {
                        if ($service['_id'] == $idToUpdate) {
                            $serviceToEdit = $service;
                            break;
                        }
                    }
                }
            }
                            break;
                            case 'create':
                                if (isset($_GET['complete'])){
                                    $service_create=false;
                                    $name= $_POST['name'];
                                    $description= $_POST['description'];
                                    $images_services=[];
                                    $servicesController->createServices($name, $description, $images_services);
                                    /*header("Location: " . $_SERVER['PHP_SELF']);*/
                                }
                                else {
                                    $service_create=true;
                                }
                                break;
}
        }

    
    //foreach ($allServices as $services){
    ?>

        <?php if ($service_create): ?>
        
    <form class="basic-form" action="admin/horaires.php?action=create&complete=true" method="POST" enctype="multipart/form-data">
        <label for="name">Apellation</label>
        <input type="text" name="name" value="" required>
        <label for="descripion">Description</label>
        <input type="text" name="description" id="description" required>
        <button class="btn" type="submit">Créer</button>
    </form>
    <?php endif;?>
    <div class="card-list">
        <?php
    $services=$servicesController->buildArrayFromIterable($allServices);
        foreach ($services as $oneServices) : 
            if ($oneServices['Name']=='Horaires'):
            ?>
    <div class="horaires">
    
        <h2><?php echo htmlspecialchars ($oneServices['Name']); ?></h2>
        <p style="font-size:medium;"><?php echo nl2br (htmlspecialchars($oneServices['Description']))?></p>

        <div class="action-buttons">

            <a href="horaires.php?action=update&id=<?php echo htmlspecialchars($oneServices['_id']);?>">

                    <button class="btn-blue-sm">modifier</button></a>

    <?php if (isset($serviceToEdit)&& $oneServices['_id']== $serviceToEdit['_id']): ?>
    
            <form class="basic-form" action="admin/horaires.php?action=update&id=<?php echo htmlspecialchars($serviceToEdit['_id']); ?>" method="POST" enctype="multipart/form-data">
                <label for="name">Horaires</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($serviceToEdit['Name']); ?>" required>
                <label for="description">Description</label>
                <textarea class="horaires-textarea" rows="7" name="description"><?php echo htmlspecialchars($serviceToEdit['Description']); ?></textarea>
                <input type="hidden" name="existingImage" value="<?php echo htmlspecialchars($serviceToEdit['Image']); ?>">

        
        <button class="btn" type="submit">Mettre à jour</button>
        
            </form>

    <?php endif; ?>

    </div>
    
    </div>
    <?php 
        endif;
        endforeach;
    //};


?>
</div>
