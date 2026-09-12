<div class="header-wrapper">
    <div class="header container">

        <div class="logo">
            Ябко
        </div>

        <div class="catalog-menu sliced-corners">
            <i class="bi bi-list"></i>
            Каталог
        </div>

        <form class="search">
            <button type="submit"><i class="bi bi-search"></i></button>
            <input type="hidden" name="page" value="category">
            <input type="text" 
                    class="sliced-corners" 
                    name="search" 
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                    autocomplete="off">
        </form>

        <ul class="right-menu list-unstyled">
            <li class="right-menu-item">
                <a href="?page=category" class="sliced-corners">Products
                    <i class="bi bi-activity"></i>
                </a>
            </li>
            <li class="right-menu-item">
                <a href="?page=product-edit" class="sliced-corners">Add product
                    <i class="bi bi-airplane-engines"></i>
                </a>
            </li>
            <li class="right-menu-item">
                <a href="/seed-products.php" class="sliced-corners" target="_blank">Seed
                    <i class="bi bi-arrow-down-left-square"></i>
                </a>
            </li>
            <li class="right-menu-item">
                <a href="#" class="sliced-corners">Cart
                    <i class="bi bi-badge-vr"></i>
                </a>
            </li>
        </ul>
    </div>
</div>