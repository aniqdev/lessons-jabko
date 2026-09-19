<?php
/** @var object $productData */

$characteristics = $productData->characteristics ?? [];
$characteristicsMore = $productData->characteristics_more ?? [];
// print_r($characteristics);
// print_r($characteristicsMore);

?>
<div class="product-info-block">
    <h2 class="product-characteristics-title fw-bold">Характеристики</h2>
    <h2 class="product-characteristics-subtitle fw-bold">Корпус и габариты</h2>
    
    <ul class="list-unstyled mb-3">

        <?php foreach ($characteristics as $property => $value): ?>
            <li class="product-characteristics-item">
                <span class="product-characteristics-label"><?php echo $property; ?></span>
                <span class="product-characteristics-value"><?php echo $value; ?></span>
            </li>
        <?php endforeach; ?>

    </ul>

    <ul class="list-unstyled mb-3" id="product_characteristics_more">

        <?php foreach ($characteristicsMore as $property => $value): ?>
            <li class="product-characteristics-item">
                <span class="product-characteristics-label"><?php echo $property; ?></span>
                <span class="product-characteristics-value"><?php echo $value; ?></span>
            </li>
        <?php endforeach; ?>

    </ul>

    <div class="text-center">
        <div class="product-characteristics-more-btn" 
            onclick="product_characteristics_more.classList.toggle('show')"
        >Все характеристики<i class="bi bi-plus-circle-fill"></i></div>
    </div>
</div>