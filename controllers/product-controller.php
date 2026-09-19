<?php

$productStore = get_products_store();

$productId = (int)$_GET['product-id'];

$product = $productStore->findById($productId);

$defaultAdvantagesJson = file_get_contents('global-data/default-advantages.json');
$defaultAdvantagesData = json_decode($defaultAdvantagesJson);

echo view('pages.product.page-product', [
    'product' => $product,
    'defaultAdvantagesData' => $defaultAdvantagesData,
]);
