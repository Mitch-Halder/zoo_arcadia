<?php

    /*session_start();*/
    class AnimalController {
        public $pdo;
        public function __construct(){
            require_once __DIR__.'/includes/config.php';
            $this->pdo=$pdo;
        }

    /* Read informations animal */
        public function read(){
            $query=$this->pdo->query('SELECT * FROM animal');
            $habitats=$query->fetchAll(PDO::FETCH_ASSOC);
            return $habitats;
        }

        /* Delete animal */
        public function delete($id){
            $query='DELETE FROM animal WHERE animal_id=:id';
            $delete=$this->pdo->prepare($query);
            $delete->bindParam(':id', $id);
            return $delete->execute();
        }

        /* Update animal */
        public function update($id, $prenom, $etat, $images_animal){
            $query='UPDATE animal SET prenom=:prenom, etat=:etat, images_animal=:images_animal WHERE animal_id=:id';
            $update=$this->pdo->prepare($query);
            $update->bindParam(':id', $id);
            $update->bindParam(':prenom', $prenom);
            $update->bindParam(':etat', $etat);
            $update->bindParam(':images_animal', $images_animal);
            return $update->execute();
        }

        /* Create animal */
        public function create($prenom, $race_id, $habitat_id, $images_animal, $etat=''){
            try{
            $image=$_FILES['image'];
            if ($image['error']===UPLOAD_ERR_OK){
                $uploadDir=__DIR__.'/Images_zoo/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); 
                }
                $fileName=uniqid().'-'.basename($image['name']);
                $filePath=$uploadDir.$fileName;
                $validPath=explode('project/', $filePath)[1];
                if (move_uploaded_file($image['tmp_name'],$filePath)){
            $query='INSERT INTO animal (prenom, race_id, habitat_id, images_animal, etat) VALUES (:prenom, :race_id, :habitat_id, ARRAY[:images_animal], :etat)';
            $create=$this->pdo->prepare($query);
            $create->bindParam(':prenom', $prenom);
            $create->bindParam(':race_id', $race_id);
            $create->bindParam(':habitat_id', $habitat_id);
            $create->bindParam(':images_animal', $validPath);
            $create->bindParam(':etat', $etat);
            return $create->execute();
        }
    }
}
    catch(Exception $e){
        echo 'exception : ', $e->getMessage();
    }
        }

        public function getPdo(){
            return $this->pdo;
        } 

        public function getRaces(){
            $query=$this->pdo->query('SELECT * FROM race');
            $races=$query->fetchAll(PDO::FETCH_ASSOC);
            return $races;
        }

        public function getHabitats(){
            $query=$this->pdo->query('SELECT * FROM habitat');
            $habitats=$query->fetchAll(PDO::FETCH_ASSOC);
            return $habitats;
    }
}