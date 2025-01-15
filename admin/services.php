<?php
    include '../includes/header.php';
    require '../servicesController.php';
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
                $idToUpdate = intval($_GET['id']);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $prenom = $_POST['prenom'];
                    if (!isset($_POST['images_service'])){
                        $images_service='{}';
                    } else {
                        $images_service = $_POST['images_service'];
                    }
                    $etat = $_POST['etat'];
                    $servicesController->update($idToUpdate, $prenom, $etat, $images_service);
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                } 
                else {
                    $services = $servicesController->read();
                    $serviceToEdit = null;
                    foreach ($services as $service) {
                        if ($service['service_id'] == $idToUpdate) {
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
                                    $race= $_POST['races'];
                                    $habitat= $_POST['habitats'];
                                    $images_service=[];
                                        $prenom = $_POST['prenom'];
                                        $servicesController->create($prenom, $race, $habitat, $images_service);
                                    /*header("Location: " . $_SERVER['PHP_SELF']);*/
                                }
                                else {
                                    $service_create=true;
                                }
                                break;
}
        }

    
    //foreach ($allServices as $services){
    $services=$servicesController->buildArrayFromIterable($allServices);
        foreach ($services as $oneServices) : 
            
            ?>
    <div class="services-container">
    
        <h4 style='font-style : italic'><?php echo htmlspecialchars ($oneServices['Name']); ?></h4>
        <p><?php echo htmlspecialchars ($oneServices['Description'])?></p>
        <a href="/project/admin/services.php?action=delete&id=<?php echo htmlspecialchars($oneServices['_id']);?>">
            <button>Supprimer</button>
        </a>
    
    </div>
    <?php
        endforeach;
    //};


?>