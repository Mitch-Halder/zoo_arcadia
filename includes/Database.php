<?php
    class Database {
        private static $instance = null;
        private $pdo;
        private function __construct() {
            ini_set('display_errors', 1);
error_reporting(E_ALL);
        try {
            //$bd = 'pgsql:host=localhost;port=5432;dbname=ARCADIA;user=postgres;password=barrywhite92';
            $bd = 'pgsql:host=ep-noisy-queen-a8vi6crd-pooler.eastus2.azure.neon.tech;port=5432;dbname=ARCADIA;user=neondb_owner;password=npg_KBeldUjMT7D5;sslmode=require;options=endpoint%3Dep-noisy-queen-a8vi6crd-pooler';
            # cat .env | grep DATABASE_URL
            //$bd="postgresql://neondb_owner:npg_KBeldUjMT7D5@ep-noisy-queen-a8vi6crd-pooler.eastus2.azure.neon.tech/ARCADIA?sslmode=require&charset=utf8";   
            $this->pdo = new PDO($bd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
?>
