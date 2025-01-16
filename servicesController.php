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
        try{
            $image=$_FILES['image'];
            if ($image['error']===UPLOAD_ERR_OK){
                $uploadDir=__DIR__.'/Images_zoo/services/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); 
                }
                $fileName=uniqid().'-'.basename($image['name']);
                $filePath=$uploadDir.$fileName;
                $validPath=explode('project/', $filePath)[1];
                if (move_uploaded_file($image['tmp_name'],$filePath)){
        $service = [
            'Name' => $name ?? '',
            'Description' => $description ?? '',
            'Image' => $validPath
        ];
        $result = $this->collection->insertOne($service);
        return $result->getInsertedId();
    }
} else {
    $service = [
        'Name' => $name ?? '',
        'Description' => $description ?? '',
        'Image' => ''
    ];
    $result = $this->collection->insertOne($service);
    return $result->getInsertedId();
}
    } catch(Exception $e){
        echo 'exception : ', $e->getMessage();
    }
}
    public function update($id, $name, $description, $image){
        $image=$_FILES['imageUpdate'];
            if ($image['error']===UPLOAD_ERR_OK){
                $uploadDir=__DIR__.'/Images_zoo/services/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); 
                }
                $fileName=uniqid().'-'.basename($image['name']);
                $filePath=$uploadDir.$fileName;
                $validPath=explode('project/', $filePath)[1];
                if (move_uploaded_file($image['tmp_name'],$filePath)){
                    $this->collection->updateOne(['_id'=>new ObjectId ($id)], ['$set'=>[
                        'Name' => $name ?? '',
                        'Description' => $description ?? '',
                        'Image' => $validPath
                    ]]);
                }
            }
        $this->collection->updateOne(['_id'=>new ObjectId ($id)], ['$set'=>[
            'Name' => $name ?? '',
            'Description' => $description ?? ''
        ]]);
    }

    public function delete($id){
        $this->collection->deleteOne(['_id'=>new ObjectId($id)]);
    }
}

?>