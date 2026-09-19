<?php 

echo view('pages.product.page-product.product-tabs', ['product' => $product]);

echo view('pages.product.page-product.product-info', ['product' => $product]);

echo view('pages.product.page-product.product-recommendations', ['product' => $product]);

echo view('pages.product.page-product.product-description', ['product' => $product]);

echo view('pages.product.page-product.product-characteristics', ['product' => $product]);

echo view('pages.product.page-product.product-reviews', [
    'product' => $product,
    'defaultAdvantagesData' => $defaultAdvantagesData,
]); 
