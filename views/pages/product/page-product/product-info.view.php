<?php
/** @var object $product */
?>
<div class="product-info-wrapper">

    <div class="product-images">
        <div class="product-image">
            <img src="<?= $product['product-image-1']; ?>" alt="">
        </div>
        <div class="product-gallery">Gallery</div>
    </div>
    
    <div class="product-info">

        <div class="product-info-block">
            <h1 class="product-title"><?= $product['product-name']; ?></h1>
            <div class="product-reviews-summary">
                <div class="product-rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                    <i class="bi bi-star"></i>
                    <span>(<?php echo rand(10, 200); ?>)</span>
                </div>
                <div class="product-availability in-stock">
                    In stock
                </div>
            </div>

            <div class="product-price-wrapper">
                <div class="product-price"><?= $product['product-price']; ?> грн</div>
                <div class="product-discount">-200 грн</div>
                <div class="product-code">Product code: 123456</div>
            </div>

            <div class="product-cashback">
                <div class="cashback-label">
                    <i class="bi bi-cash-coin"></i>
                    <span>Cashback:</span>
                </div>
                <div class="cashback-amount">+ 220 грн</div>
            </div>
            
        </div>

        <!-- product advantages block -->
        <div class="product-info-block pd-cards-block">
            <div class="product-info-cards-grid">

                <?php if (!empty($productData->advantages)): ?>

                    <?php foreach ($productData->advantages as $advantage): ?>

                    <div class="info-card-item">
                        <div class="info-card-icon text-delivery">
                        <i class="bi bi-<?php echo $advantage->icon; ?>" style="color: <?php echo $advantage->icon_color; ?>;"></i>
                        </div>
                        <span class="info-card-text" style="color: <?php echo $advantage->text_color; ?>;"><?php echo $advantage->text; ?></span>
                    </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <?php foreach ($defaultAdvantagesData as $advantage): ?>

                    <div class="info-card-item">
                        <div class="info-card-icon text-delivery">
                        <i class="bi bi-<?php echo $advantage->icon; ?>" style="color: <?php echo $advantage->icon_color; ?>;"></i>
                        </div>
                        <span class="info-card-text" style="color: <?php echo $advantage->text_color; ?>;"><?php echo $advantage->text; ?></span>
                    </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>
        </div>
        <!-- /product advantages block -->

        <!-- product options block -->
        <?php include 'blocks/product-option.php'; ?>
        <!-- /product options block -->

        <!-- product recommend block -->
        <?php include 'blocks/product-recommend.php'; ?>
        <!-- /product recommend block -->

        <div class="product-info-block product-delivery-wrapper">
            <div class="product-delivery">
                <i class="bi bi-truck"></i>
                <span>Free delivery</span>
            </div>
        </div>

        <div class="product-info-block">
            <div class="product-variants-label">Color vaiants:</div>
            <div class="product-variants">
                <a href="?color=grey"><div class="product-variant variant-grey active"></div></a>
                <a href="?color=blue"><div class="product-variant variant-blue"></div></a>
                <a href="?color=black"><div class="product-variant variant-black"></div></a>
                <a href="?color=olive"><div class="product-variant variant-olive"></div></a>
            </div>
        </div>

        <div class="product-info-block product-buy-actions">
            <div class="product-buy-btn">Buy now</div>
            <div class="product-google-pay"></div>
        </div>

        <!-- product delivery block -->
        <?php include 'blocks/product-delivery.php'; ?>
        <!-- /product delivery block -->

        <div class="product-info-block">
            <div class="product-variants-label">Гарантия и доставка:</div>
            <ul class="product-delivery-list list-unstyled">
                <li>
                    <i class="bi bi-truck"></i>
                    <span>Бесплатная доставка в магазин и отделение Новой Почты.</span>
                    <span class="info-circle product-delivery-info" data-bs-toggle="modal" data-bs-target="#deliveryModal1">i</span>
                </li>
                <li>
                    <i class="bi bi-shield-check"></i>
                    <span>Гарантия от производителя и магазина.</span>
                    <span class="info-circle product-delivery-info" data-bs-toggle="modal" data-bs-target="#deliveryModal2">i</span>
                </li>
                <li>
                    <i class="bi bi-arrow-repeat"></i>
                    <span>Быстрый обмен и возврат в течение 14 дней.</span>
                    <span class="info-circle product-delivery-info" data-bs-toggle="modal" data-bs-target="#deliveryModal3">i</span>
                </li>
            </ul>
        </div>

    </div>

</div>

