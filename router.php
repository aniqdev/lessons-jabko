<?php


if (isset($_GET['product']) && file_exists('product-data/' . $_GET['product'] . '.json')) {
    $productJson = file_get_contents('product-data/' . $_GET['product'] . '.json');
    $productData = json_decode($productJson);
} else {
    $productJson = file_get_contents('product-404.json');
    $productData = json_decode($productJson);
}



$defaultAdvantagesJson = file_get_contents('global-data/default-advantages.json');
$defaultAdvantagesData = json_decode($defaultAdvantagesJson);