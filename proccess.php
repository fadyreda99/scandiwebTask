<?php

include_once "vendor/autoload.php";

use app\models\DVDType;
use app\models\Product;
use app\models\BookType;
use app\models\FurnitureType;

$response = array(
    'success' => 0,
    'productRequierdErrors' => [],
    'uniqueProduct' => [],
    'dvdErrors' => [],
    'bookErrors' => [],
    'furnitureErrors' => [],
    'test' => ''
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['sku'])) {
        $response['productRequierdErrors']['skuMsg'] = 'SKU is required';
    }


    if (empty($_POST['name'])) {
        $response['productRequierdErrors']['nameMsg'] = 'name is required';
    }

    if (empty($_POST['price'])) {
        $response['productRequierdErrors']['priceMsg'] = 'price is required';
    }

    if ($_POST['productType'] === "0") {
        $response['productRequierdErrors']['typeMsg'] = 'productType is required';
    }

    $product = new Product;
    $product->setSKU($_POST['sku'])
        ->setName($_POST['name'])
        ->setPrice($_POST['price'])
        ->setType_id($_POST['productType']);

    if (!empty($_POST['sku'])) {
        $uniqueSKU = $product->getProductBySKU();
        if ($uniqueSKU->num_rows >= 1) {
            $response['uniqueProduct'] = 'SkU is already exists please enter unique one';
        }
    }

    if ($_POST['productType'] === "1") {
        if (empty($_POST['height'])) {
            $response['furnitureErrors']['height'] = 'height is required';
        }

        if (empty($_POST['width'])) {
            $response['furnitureErrors']['width'] = 'width is required';
        }

        if (empty($_POST['length'])) {
            $response['furnitureErrors']['length'] = 'length is required';
        }

        if (empty($response['furnitureErrors'])) {
            $furniture = new FurnitureType;
            $furniture->setHight($_POST['width'])
                ->setWidth($_POST['width'])
                ->setLength($_POST['length'])
                ->setSKU($_POST['sku']);

            if (empty($response['productRequierdErrors']) && empty($response['uniqueProduct']) && empty($response['furnitureErrors'])) {
                $product->create();
                $furniture->create();
                $response['success'] = 1;
            }
        }
    } elseif ($_POST['productType'] === "2") {
        if (empty($_POST['size'])) {
            $response['dvdErrors']['size'] = 'size is required';
        } else {
            $dvd = new DVDType;
            $dvd->setSize($_POST['size'])
                ->setSKU($_POST['sku']);

            if (empty($response['productRequierdErrors']) && empty($response['dvdErrors'])) {
                $product->create();
                $dvd->create();
                $response['success'] = 1;
            }
        }
    } elseif ($_POST['productType'] === "3") {
        if (empty($_POST['weight'])) {
            $response['bookErrors']['weight'] = 'weight is required';
        } else {
            $book = new BookType;
            $book->setWeight($_POST['weight'])
                ->setSKU($_POST['sku']);

            if (empty($response['productRequierdErrors']) && empty($response['bookErrors'])) {
                $product->create();
                $book->create();
                $response['success'] = 1;
            }
        }
    }

    echo json_encode($response);
    exit;
}
