<?php

function generate_carousel_id() {
    $bytes = random_bytes(4);
    $idSuffix = bin2hex($bytes);
    $carouselId = 'carousel-' . $idSuffix;

    return $carouselId;
}

function redirect_to($url) {
    header('Location: ' . $url);
    exit;
}

function redirect_back($fallback = '/') {
    $target = $_SERVER['HTTP_REFERER'] ?? $fallback;
    $scheme = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? '';
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    $currentAbsoluteUrl = $host !== '' ? $scheme . '://' . $host . $requestUri : $requestUri;

    if ($target === $currentAbsoluteUrl || $target === $requestUri) {
        $target = $fallback;
    }

    if ($target === $currentAbsoluteUrl || $target === $requestUri) {
        return;
    }

    redirect_to($target);
}


function query(array $params): string {
    $params = array_merge($_GET, $params);
    return '?' . http_build_query($params);
}

function get_hidden_fields(): string {
    $html = '';
    foreach ($_GET as $key => $value) {
        if ($key === 'search') continue;
        $html .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
    }
    return $html;
}

/**
 * Ensure the session is initialized safely
 */
function session_init(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 * Set a key-value pair in the session
 */
function session_set(string $key, mixed $value): void {
    session_init();
    $_SESSION[$key] = $value;
}

/**
 * Get a value from the session by key, returning a default if absent
 */
function session_get(string $key, mixed $default = null): mixed {
    session_init();
    return $_SESSION[$key] ?? $default;
}

/**
 * Remove a key from the session
 */
function session_delete(string $key): void {
    session_init();
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}

/**
 * Write a flash message into the session
 */
function flash_set(string $key, string $message): void {
    session_set("flash_{$key}", $message);
}

/**
 * Retrieve and immediately delete a flash message
 */
function flash_get(string $key): ?string {
    $fullKey = "flash_{$key}";
    $message = session_get($fullKey);
    
    if ($message !== null) {
        session_delete($fullKey);
    }
    
    return $message;
}

function pre_print(mixed $data): void {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function is_page(string $page): bool {
    return @$_GET['page'] === $page;
}

/*
 * Render a view template from the views/ directory.
 *
 * The template has access to the passed variables and to all
 * functions defined in this file (they live in the global scope).
 *
 * @param string $name   View name, dot-notation (e.g. "product.list" -> views/product/list.php)
 * @param array  $data   Variables extracted into the template scope
 * @return string        Rendered HTML
 */
function view(string $name, array $data = []): string {
    $path = __DIR__ . '/views/' . str_replace('.', '/', $name) . '.view.php';

    if (!is_file($path)) {
        throw new InvalidArgumentException("View [{$name}] not found at {$path}");
    }

    extract($data, EXTR_SKIP);
    unset($data, $name);

    ob_start();
    include $path;
    return ob_get_clean();
}


function load_controller(): void {
    
    $page = @$_GET['page'];

    if (!$page) {
        $page = 'main';
    }

    $controller = __DIR__ . '/controllers/' . $page . '-controller.php';

    if (is_file($controller)) {
        include $controller;
    } else {
        include __DIR__ . '/controllers/not-found-controller.php';
    }
}


function if_page_the_view(string $page, string $view, array $data = []): string {

    if (is_page($page)) {
        return view($view, $data);
    }

    return '';
}


function get_products_store(): \SleekDB\Store {

    static $productStore = null;

    if ($productStore === null) {
        $databaseDirectory = __DIR__ . '/sleekdb';
        $productStore = new \SleekDB\Store('products', $databaseDirectory, ['timeout' => false]);
    }

    return $productStore;
}
