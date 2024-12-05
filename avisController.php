<?php
require 'vendor/autoload.php';
use MongoDB\Client;

class AvisController {
    private $collection;
    public function __construct(){
        $client = new Client("mongodb://localhost:27017");
        $database = $client->selectDatabase('ARCADIA'); 
        $this->collection = $database->selectCollection('Avis');
    }
    public function buildArrayFromIterable($iterable) {
        $result = [];
    
        foreach ($iterable as $element) {
            $result[] = (array) $element;
        }
        return $result;
    }
    public function getAllAvis() {
        $avis = $this->collection->find();
        return $this->buildArrayFromIterable($avis);
    }
    public function createAvis($pseudo, $commentaire, $isVisible = false) {
        $avis = [
            'pseudo' => $pseudo ?? '',
            'commentaire' => $commentaire ?? '',
            'isVisible' => $isVisible
        ];
        $result = $this->collection->insertOne($avis);
        return $result->getInsertedId();
    }
}

?>