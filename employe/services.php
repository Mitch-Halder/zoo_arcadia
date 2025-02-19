<?php
    include '../includes/header.php';
    require '..controllers/ServicesController.php';
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
        <a href="/admin/services.php?action=create">
        <button class="btn">Créer services</button></a>

        <?php if ($service_create): ?>
        
    <form class="basic-form" action="admin/services.php?action=create&complete=true" method="POST" enctype="multipart/form-data">
        <label for="name">Apellation</label>
        <input type="text" name="name" value="" required>
        <label for="descripion">Description</label>
        <input type="text" name="description" id="description" required>
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
        <button class="btn" type="submit">Créer</button>
    </form>
    <?php endif;?>
    <div class="card-list">
        <?php
    $services=$servicesController->buildArrayFromIterable($allServices);
        foreach ($services as $oneServices) : 
            if ($oneServices['Name']!=='Horaires'):
            ?>
    <div class="card">
    
        <h4 style='font-style : italic'><?php echo htmlspecialchars ($oneServices['Name']); ?></h4>
        <p><?php echo htmlspecialchars ($oneServices['Description'])?></p>
        <img class="image_gallery" src="<?php echo htmlspecialchars($oneServices['Image'])?>" alt="">

        <div class="action-buttons">
        <a href="/admin/services.php?action=delete&id=<?php echo htmlspecialchars($oneServices['_id']);?>">

            <button class="btn-red-sm">supprimer</button></a>

            <a href="/admin/services.php?action=update&id=<?php echo htmlspecialchars($oneServices['_id']);?>">

                    <button class="btn-blue-sm">modifier</button></a>

    <?php if (isset($serviceToEdit)&& $oneServices['_id']== $serviceToEdit['_id']): ?>
    
            <form class="basic-form" action="admin/services.php?action=update&id=<?php echo htmlspecialchars($serviceToEdit['_id']); ?>" method="POST" enctype="multipart/form-data">

                <input type="text" name="name" value="<?php echo htmlspecialchars($serviceToEdit['Name']); ?>" required>
                <input type="text" name="description" value="<?php echo htmlspecialchars($serviceToEdit['Description']); ?>" required>
                <input type="hidden" name="existingImage" value="<?php echo htmlspecialchars($serviceToEdit['Image']); ?>">
                <input type="file" name="imageUpdate" id="imageUpdate">

        
        <button type="submit">Mettre à jour</button>
        
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