<?php
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
require $autoloadPath;
/*try {
    $bd = 'pgsql:host=localhost;port=5432;dbname=ARCADIA;user=postgres;password=barrywhite92';
    $pdo = new PDO($bd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}*/
?>