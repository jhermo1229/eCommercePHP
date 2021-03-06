<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Products.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate products object
$products = new Products($db);
// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$products->id = $data->id;

// Create Post
if($products->delete()) {
echo json_encode(
    array('message' => 'Product Deleted')
);
}else{
    echo json_encode(
        array('message' => 'Product not Deleted')
    );
}