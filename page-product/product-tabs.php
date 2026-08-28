<?php
/** @var object $product */
?>
<ul class="product-tabs list-unstyled">

    <li class="product-tab">
        <a href="#">Accessories</a>
    </li>

    <li class="product-tab">
        <a href="#">Description</a>
    </li>

    <li class="product-tab">
        <a href="#">Specifications</a>
    </li>

    <li class="product-tab">
        <a href="#">Reviews</a>
    </li>

    <li class="product-tab">
        <a href="?page=product-edit&product-id=<?= $product['_id']; ?>">
            <i class="bi bi-pencil-square"></i>
            <span>Edit</span>
        </a>
    </li>

    <li class="product-tab">
        <a href="?page=product-delete&product-id=<?= $product['_id']; ?>"
            onclick="return confirm('Are you sure?')"
        >
            <i class="bi bi-trash3"></i>
            <span>Delete</span>
        </a>
    </li>

    <li class="product-tab product-tab-sku">
        <span>SKU: MFYN4</span>
    </li>

</ul>