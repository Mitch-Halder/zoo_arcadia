<?php
require 'vendor/autoload.php';
use MongoDB\Client;
use MongoDB\BSON\ObjectId;
class statistiquesController {
    private $collection;
    public function __construct(){
        $client = new Client("mongodb://localhost:27017");
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