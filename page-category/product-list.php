<?php
/** @var object $productStore */

$pageNum = (int)($_GET['page_num'] ?? 1);
$pageNum = max(1, $pageNum);
$perPage = 6;

$search = $_GET['search'] ?? '';

// pre_print($search);

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


?>
<div class="product-list">

    <ul class="pagination list-unstyled">
        <li><a href="<?= query(['page_num' => $prevPage]) ?>" class="pagination-prev"><</a></li>
        <?php if ($pageNum > 3): ?>
            <li><a href="<?= query(['page_num' => 1]) ?>">1</a></li>
            <?php if ($pageNum > 4): ?><li class="pagination-ellipsis">...</li><?php endif; ?>
        <?php endif; ?>
        <?php for ($i = max(1, $pageNum - 1); $i <= min($totalPages, $pageNum + 1); $i++): ?>
        <li><a href="<?= query(['page_num' => $i]) ?>"<?= $i === $pageNum ? ' class="pagination-current"' : '' ?>><?= $i ?></a></li>
        <?php endfor; ?>
        <?php if ($pageNum < $totalPages - 2): ?>
            <?php if ($pageNum < $totalPages - 3): ?><li class="pagination-ellipsis">...</li><?php endif; ?>
            <li><a href="<?= query(['page_num' => $totalPages]) ?>"><?= $totalPages ?></a></li>
        <?php endif; ?>
        <li><a href="<?= query(['page_num' => $nextPage]) ?>" class="pagination-next">></a></li>
    </ul>

    <div class="row">
        <?php foreach($products as $product): ?>
        <div class="col-md-4">
            <div class="product-item">
                <a 
                    href="?page=product-delete&product-id=<?= $product['_id']; ?>"
                    class="product-delete-link"
                    onclick="return confirm('Are you sure?');"
                    title="Delete product"
                    >
                    <i class="bi bi-trash"></i>
                </a>
                <a href="?page=product-edit&product-id=<?= $product['_id']; ?>" class="product-edit-link" title="Edit product">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <div class="product-item-slider">
                    <?php include 'blocks/product-list-item-slider.php'; ?>
                </div>
                <div class="product-item-rating">
                    <div class="rating-stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>
                    </div>
                    <span>(<?php echo rand(1, 99); ?>)</span>
                </div>

                <h2 class="product-title">
                    <a href="?page=product&product-id=<?= $product['_id']; ?>">
                        <?= $product['product-name']; ?>
                    </a>
                </h2>

                <div class="product-item-footer">
                    <button class="buy-btn">Buy now</button>
                    <div class="product-item-price">
                        <span><?= $product['product-price']; ?></span>
                        <span>€</span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <ul class="pagination list-unstyled">
        <li><a href="<?= query(['page_num' => $prevPage]) ?>" class="pagination-prev"><</a></li>
        <?php if ($pageNum > 3): ?>
            <li><a href="<?= query(['page_num' => 1]) ?>">1</a></li>
            <?php if ($pageNum > 4): ?><li class="pagination-ellipsis">...</li><?php endif; ?>
        <?php endif; ?>
        <?php for ($i = max(1, $pageNum - 1); $i <= min($totalPages, $pageNum + 1); $i++): ?>
        <li><a href="<?= query(['page_num' => $i]) ?>"<?= $i === $pageNum ? ' class="pagination-current"' : '' ?>><?= $i ?></a></li>
        <?php endfor; ?>
        <?php if ($pageNum < $totalPages - 2): ?>
            <?php if ($pageNum < $totalPages - 3): ?><li class="pagination-ellipsis">...</li><?php endif; ?>
            <li><a href="<?= query(['page_num' => $totalPages]) ?>"><?= $totalPages ?></a></li>
        <?php endif; ?>
        <li><a href="<?= query(['page_num' => $nextPage]) ?>" class="pagination-next">></a></li>
    </ul>

</div>