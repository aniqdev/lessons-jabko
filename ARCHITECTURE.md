# Архитектура проекта: переход на MVC

Цель: минимальные изменения, максимальный порядок. Без фреймворков, без переписывания с нуля.

---

## Что не так сейчас

- `index.php` делает всё: конфигурация, сессии, база данных, роутинг, HTML
- Логика работы с БД разбросана прямо по шаблонам (`page-product.php`, `page-category.php`)
- Нет чёткой границы между "что делает" и "что показывает"

---

## Предлагаемая структура (минимальный MVC)

```
jabko/
├── app/
│   ├── models/
│   │   └── ProductModel.php       # вся логика работы с БД
│   └── controllers/
│       ├── ProductController.php  # логика страницы продукта
│       └── CategoryController.php # логика страницы каталога
├── views/                         # сюда переезжают page-*.php и блоки
│   ├── product/
│   │   └── show.php               # бывший page-product.php
│   ├── category/
│   │   └── index.php              # бывший page-category.php
│   └── layouts/
│       ├── header.php
│       └── footer.php
├── index.php                      # только точка входа — подключает роутер
├── router.php                     # роутинг → вызов контроллеров
├── init-db.php
└── functions.php
```

**Не нужно переносить всё сразу.** Достаточно начать с одной страницы.

---

## Шаг 1 — Выносим логику БД в модель

Создай `app/models/ProductModel.php`:

```php
<?php

class ProductModel
{
    private $store;

    public function __construct($store)
    {
        $this->store = $store;
    }

    public function findById(int $id): ?array
    {
        return $this->store->findById($id);
    }

    public function findAll(int $page = 1, int $perPage = 6): array
    {
        return $this->store
            ->createQueryBuilder()
            ->limit($perPage)
            ->skip(($page - 1) * $perPage)
            ->getQuery()
            ->fetch();
    }

    public function search(string $query): array
    {
        return $this->store
            ->createQueryBuilder()
            ->where(['product-name', 'LIKE', $query])
            ->getQuery()
            ->fetch();
    }

    public function create(array $data): array
    {
        return $this->store->insert($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->store->updateById($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->store->deleteById($id);
    }

    public function count(): int
    {
        return $this->store->createQueryBuilder()->getQuery()->count();
    }
}
```

---

## Шаг 2 — Создаём контроллер

Создай `app/controllers/ProductController.php`:

```php
<?php

class ProductController
{
    private ProductModel $model;

    public function __construct(ProductModel $model)
    {
        $this->model = $model;
    }

    public function show(int $id): void
    {
        $product = $this->model->findById($id);

        if (!$product) {
            http_response_code(404);
            echo 'Продукт не найден';
            return;
        }

        // передаём переменную во view — просто include
        include __DIR__ . '/../../views/product/show.php';
    }

    public function store(array $data): void
    {
        // минимальная валидация
        $name  = trim($data['product-name'] ?? '');
        $price = trim($data['product-price'] ?? '');

        if (!$name || !$price) {
            redirect_back();
            return;
        }

        $this->model->create([
            'product-name'   => htmlspecialchars($name),
            'product-price'  => htmlspecialchars($price),
            'product-instock' => isset($data['product-instock']),
            'product-image-1' => $data['product-image-1'] ?? '',
            'product-image-2' => $data['product-image-2'] ?? '',
            'product-image-3' => $data['product-image-3'] ?? '',
            'product-description' => htmlspecialchars($data['product-description'] ?? ''),
        ]);

        redirect_to('index.php?page=category');
    }

    public function destroy(int $id): void
    {
        $this->model->delete($id);
        redirect_to('index.php?page=category');
    }
}
```

---

## Шаг 3 — Упрощаем роутер

`router.php` сейчас почти пустой. Замени его содержимое:

```php
<?php

require_once __DIR__ . '/app/models/ProductModel.php';
require_once __DIR__ . '/app/controllers/ProductController.php';

$productModel      = new ProductModel($productStore);  // $productStore уже создан в index.php
$productController = new ProductController($productModel);

$page   = $_GET['page']       ?? 'category';
$id     = (int)($_GET['product-id'] ?? 0);
$method = $_SERVER['REQUEST_METHOD'];

match (true) {
    $page === 'product' && $id > 0               => $productController->show($id),
    $page === 'product-edit' && $method === 'POST' => $productController->store($_POST),
    $page === 'product-delete' && $id > 0        => $productController->destroy($id),
    default                                       => include __DIR__ . '/views/category/index.php',
};
```

---

## Шаг 4 — View остаётся PHP-шаблоном

Переименуй `page-product.php` → `views/product/show.php`.  
Содержимое не меняй — шаблон уже использует переменную `$product`, которую теперь передаёт контроллер через `include`.

Это и есть MVC:
- **Model** — `ProductModel` знает о БД
- **Controller** — `ProductController` знает о запросе и вызывает модель
- **View** — PHP-шаблон знает только о `$product` и рендерит HTML

---

## Порядок внедрения (рекомендуемый)

1. Создай `app/models/ProductModel.php` — не трогая остальной код
2. Подключи модель в `index.php`, убери прямые вызовы `$productStore` из шаблонов
3. Создай `app/controllers/ProductController.php`
4. Обнови `router.php` — теперь он делегирует контроллерам
5. Перемести шаблоны в `views/` по одному, начиная с `page-product.php`

Каждый шаг можно сделать отдельно — приложение продолжает работать после каждого.

---

## Что не стоит делать сейчас

- Переходить на Laravel/Symfony — это другой проект, не рефакторинг
- Добавлять Twig или другой шаблонизатор — PHP-шаблоны работают нормально
- Переписывать CSS и JS — это не архитектурная проблема
- Мигрировать на MySQL — SleekDB справляется с текущим масштабом

---

## Итоговый результат

До:
```
index.php → подключает все шаблоны напрямую, содержит логику БД и роутинг
```

После:
```
index.php → router.php → Controller → Model
                       ↘ View (PHP-шаблон)
```

Код становится читаемым, тестируемым и расширяемым без переписывания всего проекта.
