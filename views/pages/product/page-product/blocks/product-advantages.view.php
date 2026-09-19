<?php
/** @var object $productData */
/** @var object $defaultAdvantagesData */
?>

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

