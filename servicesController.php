<?php
require 'vendor/autoload.php';
use MongoDB\Client;
use MongoDB\BSON\ObjectId;
class ServicesController {
    private $collection;
    public function __construct(){
        $client = new Client("mongodb://localhost:27017");
        $database = $client->selectDatabase('ARCADIA'); 
        $this->collection = $database->selectCollection('Services');
    }
    public function buildArrayFromIterable($iterable) {
        $result = [];
    
        foreach ($iterable as $element) {
            $result[] = (array) $element;
        }
        return $result;
    }
    public function getAllServices() {
        $service = $this->collection->find();
        return $this->buildArrayFromIterable($service);
    }
    public function createServices($name, $description, $image) {
        $service = [
            'Name' => $name ?? '',
            'Description' => $description ?? '',
            'Image' => $image
        ];
        $result = $this->collection->insertOne($service);
        return $result->getInsertedId();
    }
    public function update($id, $name, $description, $image){
        $this->collection->updateOne(['_id'=>new ObjectId ($id)], ['$set'=>[
            'Name' => $name ?? '',
            'Description' => $description ?? '',
            'Image' => $image
        ]]);
    }

    public function delete($id){
        $this->collection->deleteOne(['_id'=>new ObjectId($id)]);
    }
}

    

?>