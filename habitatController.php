<?php
    /*session_start();*/
    class HabitatController {
        private $pdo;
        public function __construct(){
            require_once __DIR__.'/includes/config.php';
            $this->pdo=$pdo;
        }
        public function read(){
            $query=$this->pdo->query('SELECT * FROM habitat');
            $habitats=$query->fetchAll(PDO::FETCH_ASSOC);
            return $habitats;
        }
        public function delete($id){
            $query='DELETE FROM habitat WHERE habitat_id=:id';
            $delete=$this->pdo->prepare($query);
            $delete->bindParam(':id', $id);
            return $delete->execute();
        }
        public function update($id, $nom, $description, $images){
            $query='UPDATE habitat SET nom=:nom, description=:description, images=:images WHERE habitat_id=:id';
            $update=$this->pdo->prepare($query);
            $update->bindParam(':id', $id);
            $update->bindParam(':nom', $nom);
            $update->bindParam(':description', $description);
            $update->bindParam(':images', $images);
            return $update->execute();
        }
        public function create($nom, $description, $images){
            $query='INSERT INTO habitat (nom, description, images) VALUES (:nom, :description, :images)';
            $create=$this->pdo->prepare($query);
            $create->bindParam(':nom', $nom);
            $create->bindParam(':description', $description);
            $create->bindParam(':images', $images);
            return $create->execute();
        }
    }