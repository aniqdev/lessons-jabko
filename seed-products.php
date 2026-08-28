<?php

require_once __DIR__ . '/vendor/autoload.php';

$databaseDirectory = __DIR__ . '/sleekdb';
$productStore = new \SleekDB\Store('products', $databaseDirectory, ['timeout' => false]);

$json = file_get_contents(__DIR__ . '/seed-products.json');
$products = json_decode($json, true);

$products = array_values(array_filter($products, fn($p) => !empty($p['name']) && !empty($p['images'][2])));

$products = array_map(function($p) {

    $p['product-name'] = $p['name'];
    $p['product-price'] = $p['price'];

    $p['product-instock'] = true;

    $p['product-image-1'] = $p['images'][0];
    $p['product-image-2'] = $p['images'][1];
    $p['product-image-3'] = $p['images'][2];

    return $p;
}, $products);

$productStore->insertMany($products);

echo 'Done! Inserted ' . count($products) . ' products.';
