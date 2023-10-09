<?php

$request = $_SERVER['REQUEST_URI'];

// echo $request;

switch ($request) {

    case '/07-10-2023':
    case '/07-10-2023/':
        require __DIR__ . '/view/allproducts.php';
        break;

    case '/07-10-2023/add-product':
    case '/07-10-2023/add-product/':
        require __DIR__ . '/view/addproduct.php';
        break;

    default:
        http_response_code(404);
        echo "PAGE NOT FOUND";
        break;
}