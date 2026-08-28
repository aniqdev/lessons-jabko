<pre>
<?php

/** @var object $productStore */

// print_r($_POST);

$alertMessage = '';

if (!empty($_POST['product-name']) && empty($_GET['product-id'])) {
    $productData = [
        'product-name' => $_POST['product-name'],
        'product-price' => $_POST['product-price'],
        'product-image-1' => $_POST['product-image-1'],
        'product-image-2' => $_POST['product-image-2'],
        'product-image-3' => $_POST['product-image-3'],
        'product-description' => $_POST['product-description'],
    ];

    $product = $productStore->insert($productData);

    $alertMessage = 'Product added successfully!';
}

if (!empty($_GET['product-id'])) {
    $product = $productStore->findById($_GET['product-id']);

    if (!empty($_POST['product-name'])) {
        $productData = [
            'product-name' => $_POST['product-name'],
            'product-price' => $_POST['product-price'],
            'product-image-1' => $_POST['product-image-1'],
            'product-image-2' => $_POST['product-image-2'],
            'product-image-3' => $_POST['product-image-3'],
            'product-description' => $_POST['product-description'],
        ];

        $product = $productStore->updateById($_GET['product-id'], $productData);

        $alertMessage = 'Product updated successfully!';
    }
}


?>
</pre>

<div class="">
    <h3>Add/Edit Product</h3>

    <?php if ($alertMessage): ?>
        <div class="alert alert-primary" role="alert">
            <?= $alertMessage ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="product-name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product-name" value="<?= @$product['product-name']; ?>" aria-describedby="product-name-help">
                    <div id="product-name-help" class="form-text">Enter the product name</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="product-price" class="form-label">Product Price</label>
                    <input type="text" class="form-control" name="product-price" value="<?= @$product['product-price']; ?>" aria-describedby="product-price-help">
                    <div id="product-price-help" class="form-text">Enter the product price</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="product-image" class="form-label">Product Image 1</label>
                    <input type="text" class="form-control" name="product-image-1" value="<?= @$product['product-image-1']; ?>" aria-describedby="product-image-help">
                    <div id="product-image-help" class="form-text">Insert the product image URL</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="product-image" class="form-label">Product Image 2</label>
                    <input type="text" class="form-control" name="product-image-2" value="<?= @$product['product-image-2']; ?>" aria-describedby="product-image-help">
                    <div id="product-image-help" class="form-text">Insert the product image URL</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="product-image" class="form-label">Product Image 3</label>
                    <input type="text" class="form-control" name="product-image-3" value="<?= @$product['product-image-3']; ?>" aria-describedby="product-image-help">
                    <div id="product-image-help" class="form-text">Insert the product image URL</div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="product-description" class="form-label">Product Description</label>
            <textarea class="form-control" name="product-description" rows="3"><?= @$product['product-description']; ?></textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="product-instock" name="product-instock" <?= @$product['product-instock'] ? 'checked' : ''; ?>>
            <label class="form-check-label" for="product-instock">In stock</label>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>

        <button type="submit" class="btn btn-primary">Save and return</button>

    </form>

</div>