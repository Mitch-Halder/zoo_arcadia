<?php
    require_once '../animalController.php';
    require_once '../rapportController.php';
    session_start();
    /*include './includes/config.php';*/
    $animal=new AnimalController();
    $rapport=new RapportController($animal->getPdo());
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
                    print_r($_POST);
                    $date=$_POST['date'] ? $_POST['date']:'';
                    $detail=$_POST['detail'] ? $_POST['detail']:'';
                    $selection=$_POST['selection'] ? $_POST['selection']:'';
                    $user=$_SESSION['user'] ? $_SESSION['user']:'';
                    $rapport->create($date, $detail, $user, $selection);
                                    break;
        }
    }
    if (!isset($animals)){
    $animals=$animal->read();
    }    
    ?>
    <head>
        <style>
            .option-image{
                width: 50px;
                height: 80px;
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
    <form action="employe.php?action=create" method="POST">
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
            <input type="date" name="date" id="date">
            <textarea name="detail" id="detail" cols="30" rows="10"></textarea>
            
    <!--</select>-->
        <button type="submit">Soumettre</button>
    </form>
    