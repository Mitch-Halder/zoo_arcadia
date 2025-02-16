<?php
    include '../includes/header.php';
    require '../controllers/AvisController.php';
    $avisController = new AvisController();
    $allAvis = $avisController->getAllAvis(); 
    function buildArrayFromIterable($iterable) {
        $result = [];

        foreach ($iterable as $element) {
            $result[] = (array) $element;
        }

            return $result;
    }
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $data=json_decode($_POST['data'], true);
        if($data['_id']){
            $avisController->updateVisible($data['_id']['$oid'], $data['isVisible'] ? false : true);
            header("Location: " . $_SERVER['PHP_SELF']);
        }
        
    }
    //foreach ($allAvis as $avis){
    $avis = buildArrayFromIterable ($allAvis);
        foreach ($avis as $oneAvis) : 
            //print_r ($oneAvis ['commentaire']);
?>
    <div class="avis-container">
    <form class="avis" method="POST">
        <h4 style='font-style : italic'><?php echo htmlspecialchars ($oneAvis['pseudo']); ?></h4><p><?php echo $oneAvis['isVisible'] ? '(visible)':'(notVisible)'?></p>
        <p><?php echo htmlspecialchars ($oneAvis['commentaire'])?></p>
        <input type="hidden" name="data" value="<?php echo htmlspecialchars(json_encode($oneAvis))?>">
        <button type="submit" class="change-button">
            change
        </button>
    </form>
    </div>
    <?php
        endforeach;
    //};

