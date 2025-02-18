<?php
    /*session_start();*/
    require_once __DIR__ . '/../includes/Database.php';
    class AlimentationController {
        //private $pdo;

        public function __construct(){
            require_once dirname(__DIR__).'/includes/config.php';
            $this->pdo=Database::getInstance();
        }

        public function read(){
            $query=$this->pdo->query('SELECT * FROM alimentation JOIN animal ON alimentation.animal_id=animal.animal_id');
            
            $alimentations=$query->fetchAll(PDO::FETCH_ASSOC);
            return $alimentations;
        }

        public function delete($id){
            $query='DELETE FROM alimentation WHERE alimentation=:id';
            $delete=$this->pdo->prepare($query);
            $delete->bindParam(':id', $id);
            return $delete->execute();
        }

        public function update($id, $date, $detail, $user_id, $animal_id){
            $query='UPDATE alimentation SET date=:date, detail=:detail, user_id=:user_id, animal_id=:animal_id WHERE alimentation_id=:id';
            $update=$this->pdo->prepare($query);
            $update->bindParam(':id', $id);
            $update->bindParam(':date', $date);
            $update->bindParam(':detail', $detail);
            $update->bindParam(':user_id', $user_id);
            $update->bindParam(':animal_id', $animal_id);
            return $update->execute();
        }

        public function create($date, $detail, $user_id, $animal_id){
            $query='INSERT INTO alimentation (date, detail, user_id, animal_id) VALUES (:date, :detail, :user_id, :animal_id)';
            $create=$this->pdo->prepare($query);
            $create->bindParam(':date', $date);
            $create->bindParam(':detail', $detail);
            $create->bindParam(':user_id', $user_id);
            $create->bindParam(':animal_id', $animal_id);
            return $create->execute();
        }

        public function getAlimentationById($idAlimentation){
            $query=$this->pdo->prepare('SELECT * FROM alimentation JOIN animal ON alimentation.animal_id=animal.animal_id WHERE alimentation.alimentation_id=?');
            $query->execute([$idAlimentation]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
    }
        public function getAlimentationByAnimalId($idAnimal){
            $query=$this->pdo->prepare('SELECT * FROM alimentation JOIN animal ON alimentation.animal_id=animal.animal_id WHERE alimentation.animal_id=?');
            $query->execute([$idAnimal]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}