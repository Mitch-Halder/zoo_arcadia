<?php
    /*session_start();*/
    class RapportController {
        /*private $pdo;*/
        public function __construct($pdo){
            require_once __DIR__.'/includes/config.php';
            $this->pdo=$pdo;
        }
        public function read(){
            $query=$this->pdo->query('SELECT * FROM rapport_veterinaire');
            $rapports=$query->fetchAll(PDO::FETCH_ASSOC);
            return $rapports;
        }
        public function delete($id){
            $query='DELETE FROM rapport_veterinaire WHERE rapport_veterinaire=:id';
            $delete=$this->pdo->prepare($query);
            $delete->bindParam(':id', $id);
            return $delete->execute();
        }
        public function update($id, $date, $detail, $user_id, $animal_id){
            $query='UPDATE rapport SET date=:date, detail=:detail, user_id=:user_id, animal_id=:animal_id WHERE rapport_veterinaire_id=:id';
            $update=$this->pdo->prepare($query);
            $update->bindParam(':id', $id);
            $update->bindParam(':date', $date);
            $update->bindParam(':detail', $detail);
            $update->bindParam(':user_id', $user_id);
            $update->bindParam(':animal_id', $animal_id);
            return $update->execute();
        }
        public function create($date, $detail, $user_id, $animal_id){
            $query='INSERT INTO rapport_veterinaire (date, detail, user_id, animal_id) VALUES (:date, :detail, :user_id, :animal_id)';
            $create=$this->pdo->prepare($query);
            $create->bindParam(':date', $date);
            $create->bindParam(':detail', $detail);
            $create->bindParam(':user_id', $user_id);
            $create->bindParam(':animal_id', $animal_id);
            return $create->execute();
        }
    }