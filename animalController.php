<?php
    /*session_start();*/
    class AnimalController {
        private $pdo;
        public function __construct(){
            require_once __DIR__.'/includes/config.php';
            $this->pdo=$pdo;
        }
        public function read(){
            $query=$this->pdo->query('SELECT * FROM animal');
            $habitats=$query->fetchAll(PDO::FETCH_ASSOC);
            return $habitats;
        }
        public function delete($id){
            $query='DELETE FROM animal WHERE animal_id=:id';
            $delete=$this->pdo->prepare($query);
            $delete->bindParam(':id', $id);
            return $delete->execute();
        }
        public function update($id, $prenom, $etat, $images_animal){
            $query='UPDATE animal SET prenom=:prenom, etat=:etat, images_animal=:images_animal WHERE animal_id=:id';
            $update=$this->pdo->prepare($query);
            $update->bindParam(':id', $id);
            $update->bindParam(':prenom', $prenom);
            $update->bindParam(':etat', $etat);
            $update->bindParam(':images_animal', $images_animal);
            return $update->execute();
        }
        public function create($prenom, $etat, $images_animal){
            $query='INSERT INTO animal (prenom, etat, images_animal) VALUES (:prenom, :etat, :images_animal)';
            $create=$this->pdo->prepare($query);
            $create->bindParam(':prenom', $prenom);
            $create->bindParam(':etat', $etat);
            $create->bindParam(':images_animal', $images_animal);
            return $create->execute();
        }
    }