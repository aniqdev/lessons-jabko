<div class="product-recomendations">
    <h2 class="product-recomendations-title product-info-block">
        <span class="border-bottom">Рекомендуем к покупке</span>
    </h2>
    <ul class="product-recomendations-cards list-unstyled">

        <?php for ($i = 0; $i < 3; $i++): ?>
            <li class="product-recomendations-card product-info-block">
                <img class="card-image" src="https://img.jabko.ua/image/cache/catalog/products/2025/07/112128/2-430x421.jpg.webp" alt="">
                <h3 class="card-title">Название товара</h3>
                <div class="devider"></div>
                <div class="prices">
                    <span class="price">1 659 грн</span>
                    <span class="price-old">1 799 грн</span>
                </div>
                <button class="add-to-cart-btn">Добавить</button>
            </li>
        <?php endfor; ?>

    </ul>
</div>