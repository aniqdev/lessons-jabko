<?php
/** @var object $productData */

    // $product = get_current_product();

?>
<div class="product-reviews product-info-block">
    <h3 class="product-reviews-title">Reviews to <?php echo $productData->title; ?></h3>
    
    <div class="product-reviews-rating">
        <div class="rating-title">Average Rating:</div>
        <div class="rating-stars">
            <?php
            $rating = $productData->rating ?? 0;
            for($i = 1; $i <= 5; $i++):
                if ($rating == 0) {
                    echo '<i class="bi bi-star" style="color: grey;"></i>';
                } elseif ($i <= $rating) {
                    echo '<i class="bi bi-star-fill"></i>';
                } elseif ($i == ceil($rating)) {
                    echo '<i class="bi bi-star-half"></i>';
                } else {
                    echo '<i class="bi bi-star"></i>';
                }

            endfor;
            ?>
        </div>
        <div class="rating-count">(<?php echo $productData->reviews_count ?? 0; ?> reviews)</div>
    </div>

    <form class="product-reviews-form" method="POST">

        <input type="hidden" name="product-id" value="<?php echo $productData->_id; ?>">

        <div class="row align-items-center">

            <div class="col-xl-6 mb-4">
                <input class="name-input" type="text" placeholder="Your name">
            </div>

            <div class="col-xl-6 mb-4">
                <div class="form-rating">
                    <div class="rating-title">Your Rating:</div>
                    <div class="rating-stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
            </div>

        </div>

        <textarea class="review-input" placeholder="Your review"></textarea>

        <div class="row">
            <div class="col-md-6">
                <button class="submit-btn" name="add-product-review" value="1">Submit Review</button>
            </div>
            <div class="col-md-6">
                <input class="file-input" type="file">
            </div>
        </div>

    </form>

</div>

<ul class="comments-list list-unstyled">
    <?php for($i = 1; $i <= 5; $i++): ?>
    <li class="comment-item product-info-block">
        <div class="comment-author">John Doe</div>
        <div class="comment-rating">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
        </div>
        <div class="comment-content">
            <p>This product is amazing! I love it.</p>
        </div>
        <div class="comment-devider"></div>
        <div class="comment-footer">
            <div class="comment-like-btn">
                <i class="bi bi-hand-thumbs-up"></i>
                <span>Like</span>
            </div>
            <div class="comment-icon">
                <i class="bi bi-chat-left-text-fill"></i>
            </div>
        </div>
    </li>
    <?php endfor; ?>
</ul>