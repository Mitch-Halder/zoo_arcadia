<?php
    /*session_start();*/
    class UserController {
        private $pdo;
        public function __construct(){
            require_once __DIR__.'/includes/config.php';
            $this->pdo=$pdo;
        }
        public function read(){
            $query=$this->pdo->query('SELECT * FROM user');
            $users=$query->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }

        public function getRoles(){
            $query=$this->pdo->query('SELECT * FROM role WHERE role_id!=1');
            $roles=$query->fetchAll(PDO::FETCH_ASSOC);
            return $roles;
        }
        /*public function delete($id){
            $query='DELETE FROM user WHERE user_id=:id';
            $delete=$this->pdo->prepare($query);
            $delete->bindParam(':id', $id);
            return $delete->execute();
        }
        public function update($id, $firstname, $name, $username, $password){
            $query='UPDATE user SET firstname=:firstname, etat=:etat, images_user=:images_user WHERE user_id=:id';
            $update=$this->pdo->prepare($query);
            $update->bindParam(':id', $id);
            $update->bindParam(':firstname', $firstname);
            $update->bindParam(':etat', $etat);
            $update->bindParam(':images_user', $images_user);
            return $update->execute();
        }*/
        public function create($firstname, $name, $username, $password, $role){
            $query='INSERT INTO users (firstname, name, username, password, role_id) VALUES (:firstname, :name, :username, :password, :role)';
            $create=$this->pdo->prepare($query);
            $create->bindParam(':firstname', $firstname);
            $create->bindParam(':name', $name);
            $create->bindParam(':username', $username);
            $create->bindParam(':password', $password);
            $create->bindParam(':role', $role);
            return $create->execute();
        }
    }