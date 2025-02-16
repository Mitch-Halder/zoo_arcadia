<?php
    /*session_start();*/
    class RapportController {
        //private $pdo;

        public function __construct($pdo){
            require_once dirname(__DIR__).'/includes/config.php';
            $this->pdo=$pdo;
        }

        public function read(){
            $query=$this->pdo->query('SELECT * FROM rapport_veterinaire JOIN animal ON rapport_veterinaire.animal_id=animal.animal_id');
            /*$query=$this->pdo->query('WITH rapports_aggreges AS (
            SELECT 
                animal_id,
                MAX(date) AS dernier_rapport,
                COUNT(*) AS nombre_rapports
            FROM 
                rapport_veterinaire
            GROUP BY 
                animal_id
        )
        SELECT 
            a.*,                    
            rv.*,                   
            ra.dernier_rapport,     
            ra.nombre_rapports      
        FROM 
            animal a
        INNER JOIN 
            rapports_aggreges ra
            ON a.animal_id = ra.animal_id
        INNER JOIN 
           (SELECT DISTINCT ON (animal_id) * 
            FROM rapport_veterinaire 
            ORDER BY animal_id, date DESC) rv
            ON a.animal_id = rv.animal_id AND rv.date = ra.dernier_rapport
            ; 
            ');*/
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

        public function getRapportById($idRapport){
            $query=$this->pdo->prepare('SELECT * FROM rapport_veterinaire JOIN animal ON rapport_veterinaire.animal_id=animal.animal_id WHERE rapport_veterinaire.rapport_veterinaire_id=?');
            $query->execute([$idRapport]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
    }
        public function getRapportByAnimalId($idAnimal){
            $query=$this->pdo->prepare('SELECT * FROM rapport_veterinaire JOIN animal ON rapport_veterinaire.animal_id=animal.animal_id WHERE rapport_veterinaire.animal_id=?');
            $query->execute([$idAnimal]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}