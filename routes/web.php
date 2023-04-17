<?php

use App\Controllers\ProductController;
use app\Controllers\ProductTypeVariants;
use app\Controllers\ProductTypesController;


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}

$router = new Routing();

$router->addRoute('/getProductTypes', function() {
    return ( new ProductTypesController())->index();
});

$router->addRoute('/getProductTypeVariants/:productTypeId', function($productTypeId) {
    return ( new ProductTypeVariants())->index($productTypeId);
});

$router->addRoute('/addProduct', function() {
    return (new ProductController())->store();
});

$router->addRoute('/deleteProducts', function() {
    return (new ProductController())->deleteAll();
});

$router->addRoute('/getProducts', function() {
    return (new ProductController())->index();
});

$router->run();