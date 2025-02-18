<?php
//require '../vendor/autoload.php';
use MongoDB\Client;
use MongoDB\BSON\ObjectId;
class statistiquesController {
    private $collection;
    public function __construct(){
        require_once dirname(__DIR__).'/includes/config.php';
        
$uri = 'mongodb://Jean-Michel:Pitchoune131005@cluster0-shard-00-00.4ljrt.mongodb.net:27017,cluster0-shard-00-01.4ljrt.mongodb.net:27017,cluster0-shard-00-02.4ljrt.mongodb.net:27017/?ssl=true&replicaSet=atlas-p7zdx2-shard-0&authSource=admin&retryWrites=true&w=majority&appName=Cluster0&tlsAllowInvalidCertificates=true';

// Create a new client and connect to the server
$client = new MongoDB\Client($uri);

try {
    $client->selectDatabase('admin')->command(['ping' => 1]);
} catch (Exception $e) {
    printf($e->getMessage());
}
        $database = $client->selectDatabase('ARCADIA'); 
        $this->collection = $database->selectCollection('Statistiques');
    }

    public function buildArrayFromIterable($iterable) {
        $result = [];
    
        foreach ($iterable as $element) {
            $result[] = (array) $element;
        }
        return $result;
    }

    public function getAllStatistiques() {
        $statistique = $this->collection->find([], ['sort' => ['score' => -1]]);
        return $this->buildArrayFromIterable($statistique);
    }
}

?>