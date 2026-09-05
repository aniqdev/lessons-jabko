# Архитектура проекта: процедурный MVC (без классов)

Цель: разделить код на три роли — данные, логика, отображение.  
Инструменты: только функции, `include`, `require`.

---

## Три роли в MVC

| Слой | Что делает | Чем является в коде |
|------|-----------|---------------------|
| **Model** | работает с данными (БД) | файл с функциями |
| **Controller** | обрабатывает запрос, готовит переменные | PHP-файл с логикой |
| **View** | отображает HTML | PHP-шаблон (уже есть) |

---

## Предлагаемая структура

```
jabko/
├── models/
│   └── product.php        # функции для работы с продуктами
├── controllers/
│   ├── product.php        # логика страницы продукта
│   └── category.php       # логика каталога
├── views/                 # сюда переезжают page-*.php и блоки
│   ├── product/
│   │   └── show.php       # бывший page-product.php
│   └── category/
│       └── index.php      # бывший page-category.php
├── index.php              # точка входа: подключает всё нужное + роутер
├── router.php             # решает, какой контроллер запустить
├── functions.php          # вспомогательные функции (уже есть)
└── init-db.php            # инициализация БД (уже есть)
```

---

## Шаг 1 — Геттер для хранилища

Вместо того чтобы писать `global $productStore` в каждой функции модели, добавь одну функцию-геттер в `init-db.php`:

```php
// init-db.php (дополнить)

function product_store()
{
    global $productStore;
    return $productStore;
}
```

`global` теперь живёт только здесь — один раз. Все остальные функции просто вызывают `product_store()`.

---

## Шаг 2 — Model: функции для БД

Создай `models/product.php`.  
Здесь только функции, которые умеют работать с хранилищем. Никакой логики запросов, никакого HTML.

```php
<?php
// models/product.php

function product_find_by_id(int $id): ?array
{
    return product_store()->findById($id);
}

function product_find_all(int $page = 1, int $per_page = 6): array
{
    return product_store()
        ->createQueryBuilder()
        ->limit($per_page)
        ->skip(($page - 1) * $per_page)
        ->getQuery()
        ->fetch();
}

function product_count(): int
{
    return product_store()->createQueryBuilder()->getQuery()->count();
}

function product_search(string $query): array
{
    return product_store()
        ->createQueryBuilder()
        ->where(['product-name', 'LIKE', $query])
        ->getQuery()
        ->fetch();
}

function product_create(array $data): array
{
    return product_store()->insert($data);
}

function product_update(int $id, array $data): bool
{
    return product_store()->updateById($id, $data);
}

function product_delete(int $id): bool
{
    return product_store()->deleteById($id);
}
```

> **Правило модели**: функции модели знают только о базе данных. Они не знают о `$_GET`, `$_POST`, о сессиях, о HTML.

---

## Шаг 3 — Controller: логика запроса

Контроллер — это PHP-файл, который:
1. Читает данные из `$_GET` / `$_POST`
2. Вызывает нужные функции модели
3. Кладёт результат в переменные
4. Подключает нужный view через `include`

Создай `controllers/product.php`:

```php
<?php
// controllers/product.php

$id = (int) ($_GET['product-id'] ?? 0);

if ($id <= 0) {
    redirect_to('index.php?page=category');
}

$product = product_find_by_id($id);

if ($product === null) {
    http_response_code(404);
    echo 'Продукт не найден';
    exit;
}

include __DIR__ . '/../views/product/show.php';
```

Создай `controllers/category.php`:

```php
<?php
// controllers/category.php

$page_num   = (int) ($_GET['p'] ?? 1);
$search     = trim($_GET['search'] ?? '');

if ($search !== '') {
    $products = product_search($search);
    $total    = count($products);
} else {
    $products = product_find_all($page_num);
    $total    = product_count();
}

$total_pages = (int) ceil($total / 6);

include __DIR__ . '/../views/category/index.php';
```

> **Правило контроллера**: он не пишет HTML и не обращается напрямую к `$productStore`. Только вызывает функции модели и вызывает view.

---

## Шаг 4 — View: только HTML и вывод

View — это обычный PHP-шаблон. Он получает готовые переменные от контроллера и отображает их.

Переименуй `page-product.php` → `views/product/show.php`.  
Содержимое не меняй. Только убедись, что вся логика (запрос к БД, проверка `$_GET`) вынесена в контроллер.

> **Правило view**: он не знает о `$_GET`, `$_POST`, не вызывает функции модели. Только выводит то, что ему передал контроллер.

---

## Шаг 5 — Router: кто куда идёт

`router.php` смотрит на `$_GET['page']` и подключает нужный контроллер:

```php
<?php
// router.php

require_once __DIR__ . '/models/product.php';

$page = $_GET['page'] ?? 'category';

if ($page === 'product') {
    require __DIR__ . '/controllers/product.php';

} elseif ($page === 'category') {
    require __DIR__ . '/controllers/category.php';

} elseif ($page === 'product-edit') {
    require __DIR__ . '/controllers/product-edit.php';

} elseif ($page === 'product-delete') {
    require __DIR__ . '/controllers/product-delete.php';

} elseif ($page === 'login') {
    require __DIR__ . '/controllers/login.php';

} else {
    http_response_code(404);
    echo 'Страница не найдена';
}
```

---

## Шаг 6 — index.php: только точка входа

`index.php` должен быть минимальным: подключить зависимости и запустить роутер.

```php
<?php
// index.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/init-db.php';
require_once __DIR__ . '/functions.php';

require __DIR__ . '/router.php';
```

---

## Как данные передаются от контроллера во view

Через обычные переменные PHP. Контроллер объявляет переменную — view её читает.

```
Контроллер:             View:
$product = ...   →→→   <?= $product['product-name'] ?>
$products = ...  →→→   foreach ($products as $p) { ... }
$total_pages = . →→→   if ($page_num < $total_pages) { ... }
```

Это работает потому что `include` выполняется в том же контексте, где объявлены переменные.

---

## Схема потока данных

```
Браузер отправляет запрос
        ↓
index.php (подключает всё)
        ↓
router.php (смотрит на ?page=...)
        ↓
controllers/product.php
        ├── вызывает product_find_by_id($id)  ← models/product.php
        │   └── вызывает product_store()  ← init-db.php
        └── include views/product/show.php
                    ↓
              HTML → браузер
```

---

## Порядок внедрения

1. Добавь `product_store()` в `init-db.php`
2. Создай `models/product.php` с функциями — ничего не ломается, это просто новый файл
3. Подключи его в `index.php` через `require_once`
4. Замени прямые вызовы `$productStore` в шаблонах на вызовы функций модели
5. Создай папку `controllers/`, перенеси логику из шаблонов туда
6. Обнови `router.php`
7. Перемести шаблоны в `views/` — по одному

---

## Итог: что изменилось и зачем

| Было | Стало | Зачем |
|------|-------|-------|
| `$productStore->findById($id)` прямо в шаблоне | `product_find_by_id($id)` в контроллере | одно место для изменений |
| Вся логика в `index.php` | разделена по контроллерам | легче читать и искать |
| `page-product.php` делает всё | controller готовит данные, view рисует | каждый файл отвечает за одно |
| Роутинг через `if` в `index.php` | отдельный `router.php` | понятно где искать маршруты |
