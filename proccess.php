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
    'invalid' => [],
    'test' => '2'
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['sku'])) {
        $response['productRequierdErrors']['skuMsg'] = 'Please, submit required data';
    }


    if (empty($_POST['name'])) {
        $response['productRequierdErrors']['nameMsg'] = 'Please, submit required data';
    }

    if (!empty($_POST['price'])) {
        if (!is_numeric($_POST['price'])) {
            $response['invalid']['invalidPrice'] = 'invalid price, Please inter only numbers';
        }
    } else {
        $response['productRequierdErrors']['priceMsg'] = 'Please, submit required data';
    }

    if ($_POST['productType'] === "0") {
        $response['productRequierdErrors']['typeMsg'] = 'Please, submit required data';
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
        if (!empty($_POST['height'])) {
            if (!is_numeric($_POST['height'])) {
                $response['invalid']['invalidHeight'] = 'invalid height, Please inter only numbers';
            }
        } else {
            $response['furnitureErrors']['height'] = 'Please, submit required data';
        }

        if (!empty($_POST['width'])) {
            if (!is_numeric($_POST['width'])) {
                $response['invalid']['invalidWidth'] = 'invalid width, Please inter only numbers';
            }
        } else {
            $response['furnitureErrors']['width'] = 'Please, submit required data';
        }

        if (!empty($_POST['length'])) {
            if (!is_numeric($_POST['length'])) {
                $response['invalid']['invalidLength'] = 'invalid length, Please inter only numbers';
            }
        } else {
            $response['furnitureErrors']['length'] = 'Please, submit required data';
        }

        if (empty($response['furnitureErrors'])) {
            $furniture = new FurnitureType;
            $furniture->setHight($_POST['width'])
                ->setWidth($_POST['width'])
                ->setLength($_POST['length'])
                ->setSKU($_POST['sku']);

            if (empty($response['productRequierdErrors']) && empty($response['uniqueProduct']) && empty($response['furnitureErrors']) && empty($response['invalid'])) {
                $product->create();
                $furniture->create();
                $response['success'] = 1;
            }
        }
    } elseif ($_POST['productType'] === "2") {
        if (empty($_POST['size'])) {
            $response['dvdErrors']['size'] = 'Please, submit required data';
        } else {
            if (!is_numeric($_POST['size'])) {
                $response['invalid']['invalidSize'] = 'invalid size, Please inter only numbers';
            } else {
                $dvd = new DVDType;
                $dvd->setSize($_POST['size'])
                    ->setSKU($_POST['sku']);

                if (empty($response['productRequierdErrors']) && empty($response['dvdErrors'])   && empty($response['invalid'])) {
                    $product->create();
                    $dvd->create();
                    $response['success'] = 1;
                }
            }
        }
    } elseif ($_POST['productType'] === "3") {
        if (empty($_POST['weight'])) {
            $response['bookErrors']['weight'] = 'Please, submit required data';
        } else {
            if (!is_numeric($_POST['weight'])) {
                $response['invalid']['invalidWeight'] = 'invalid weight, Please inter only numbers';
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
    }

    echo json_encode($response);
    exit;
}
