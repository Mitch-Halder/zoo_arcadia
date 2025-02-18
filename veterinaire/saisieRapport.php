<?php
    include '../includes/header.php';
    require_once '../includes/guard.php';
    require_once '../controllers/AnimalController.php';
    require_once '../controllers/RapportController.php';
    /*include './includes/config.php';*/
    checkAccess(['veterinaire']);
    $animal=new AnimalController();
    $rapport=new RapportController();
    $rapport->read();
    if (isset($_GET['action'])){
        $action=$_GET['action'];
        switch ($action){
            case 'delete':
                if (isset($_GET['id'])){
                    $animal->delete($_GET['id']);
                    header('Location: animal.php');
                }
                break;
                case 'create':
                    $date=$_POST['date'] ? $_POST['date']:'';
                    $detail=$_POST['detail'] ? $_POST['detail']:'';
                    $selection=$_POST['selection'] ? $_POST['selection']:'';
                    $user=$_SESSION['user'] ? $_SESSION['user']['username']:'';
                    $rapport->create($date, $detail, $user, $selection);
                                    break;
        }
    }
    if (!isset($animals)){
    $animals=$animal->readOrderByName();
    }    
    ?>
    <head>
        <style>
            .option-image{
                width: 150px;
                height: 150px;
            }
            .options {
                display: flex;
                flex-direction: column;
                max-height: 800px;
                overflow-y: auto;
            }
        </style>
    </head>
    <!--<select>-->
    <form class="basic-form" action="admin/employe.php?action=create" method="POST">
        <div class="options">
        
        
        <?php foreach ($animals as $h):?>
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
            <label class="option-item">
      <input type="radio" name="selection" value="<?php echo htmlspecialchars($h['animal_id'])?>" class="radio-option">
      <img src="/project/<?php echo htmlspecialchars($imageArray[0])?>" alt="Image 1" class="option-image">
      <span><?php echo htmlspecialchars($h['prenom'])?></span>
    </label>

            <?php endforeach;?>
        </div>
        <label for="date">Date du rapport</label>
            <input type="date" name="date" id="date">
            <label for="detail">Détail du rapport</label>
            <textarea name="detail" id="detail" cols="30" rows="10"></textarea>
            
    <!--</select>-->
        <button class="btn-blue" type="submit">Soumettre</button>
    </form>
    