<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Products.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate products object
$products = new Products($db);
// Get raw productsed data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$products->id = $data->id;

$products->description = $data->description;
$products->productName = $data->product_name;
$products->url = $data->image_url;
$products->cost = $data->cost;

// Create products
if($products->update()) {
echo json_encode(
    array('message' => 'Product Updated')
);
}else{
    echo json_encode(
        array('message' => 'Product not Updated')
    );
}