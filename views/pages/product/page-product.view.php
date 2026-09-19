<?php

/** @var object $productStore */

$productId = (int)$_GET['product-id'];

$product = $productStore->findById($productId);

?>

<?= view('pages.product.page-product.product-tabs', ['product' => $product]); ?>

<?= view('pages.product.page-product.product-info', ['product' => $product]); ?>

<?= view('pages.product.page-product.product-recomendations', ['product' => $product]); ?>

<?= view('pages.product.page-product.product-description', ['product' => $product]); ?>

<?= view('pages.product.page-product.product-characteristics', ['product' => $product]); ?>

<?= view('pages.product.page-product.product-reviews', ['product' => $product]); ?>
