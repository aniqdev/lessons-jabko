<?php


if(!empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
} else {
    $search = '';
}


?>
<div class="page-category">

    <div class="category-header row">
        <div class="col-md-6">
            <h3><?= $search ? 'Search results for "' . $search . '"' : 'Products' ?></h3>
        </div>
        <div class="col-md-6">
            <?php include 'blocks/rating-sort.php'; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="product-filters">
                <h2>Filters</h2>
            </div>
        </div>
        <div class="col-9">
            <?php 
                if (isset($_GET['rotated'])) {
                    include 'page-category/product-list-rotated.php';
                } else {
                    include 'page-category/product-list.php'; 
                }
            ?>
        </div>
    </div>

</div>