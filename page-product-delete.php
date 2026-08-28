<?php

$productId = (int)$_GET['product-id'];

$product = $productStore->findById($productId);

$productStore->deleteById($productId);

?>

<?php if ($product): ?>
    <div class="alert alert-success" role="alert">
        Product <b><?= @$product['product-name'] ?></b> deleted successfully!
    </div>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        Product not found!
    </div>
<?php endif; ?>