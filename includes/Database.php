<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $bd = "pgsql:host=ep-noisy-queen-a8vi6crd-pooler.eastus2.azure.neon.tech;port=5432;dbname=ARCADIA;sslmode=require";
            $this->pdo = new PDO($bd, 'neondb_owner', 'npg_KBeldUjMT7D5');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (!$this->pdo) {
                throw new Exception('Impossible de se connecter à la base de données.');
            }

        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
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
