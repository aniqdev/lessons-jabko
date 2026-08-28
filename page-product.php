<?php

/** @var object $productStore */

$productId = (int)$_GET['product-id'];

$product = $productStore->findById($productId);

?>

<?php include 'page-product/product-tabs.php'; ?>

<?php include 'page-product/product-info.php'; ?>

<?php include 'page-product/product-recomendations.php'; ?>

<?php include 'page-product/product-description.php'; ?>

<?php include 'page-product/product-characteristics.php'; ?>

<?php include 'page-product/product-reviews.php'; ?>