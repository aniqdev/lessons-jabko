<?php

$pageNum = (int)($_GET['page_num'] ?? 1);
$pageNum = max(1, $pageNum);
$perPage = 6;

$search = $_GET['search'] ?? '';

// pre_print($search);

$productStore = get_products_store();

$query = $productStore->createQueryBuilder();

if ($search) {
    $query->where(['product-name', 'like', '%' . $search . '%']);
}

$totalProducts = count($query->getQuery()->fetch());

$products = $productStore->createQueryBuilder()
    ->skip(($pageNum - 1) * $perPage)
    ->limit($perPage);

if ($search) {
    $products->where(['product-name', 'like', '%' . $search . '%']);
}

$products = $products->getQuery()->fetch();

$totalPages = max(1, (int)ceil($totalProducts / $perPage));

$prevPage = max(1, $pageNum - 1);
$nextPage = min($totalPages, $pageNum + 1);

echo view('pages.category.page-category', [
    'pageNum' => $pageNum,
    'perPage' => $perPage,
    'search' => $search,
    'totalProducts' => $totalProducts,
    'products' => $products,
    'totalPages' => $totalPages,
    'prevPage' => $prevPage,
    'nextPage' => $nextPage,
]);
