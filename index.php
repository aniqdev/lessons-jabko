<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    session_start();

    require_once 'vendor/autoload.php';

    require_once 'init-db.php';

    require_once 'functions.php';

    include 'actions.php';

    include 'router.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <?php include 'header-navigation.php'; ?>

    <?php include 'header-search.php'; ?>

    <div class="breadcrumbs-container container">
        <div class="row">
            <div class="col-md-6">
                <?php include 'breadcrumbs.php'; ?>
            </div>
            <div class="col-md-6">
                <?php if (@$_GET['page'] === 'category'): ?>
                    <?php include 'blocks/sort.php'; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="main container">

        <?php

            if (@$_GET['page'] === 'category') {
                include 'page-category.php';
            }

            if (@$_GET['page'] === 'product') {
                include 'page-product.php';
            }

            if (@$_GET['page'] === 'product-edit') {
                include 'page-product-edit.php';
            }

            if (@$_GET['page'] === 'product-delete') {
                include 'page-product-delete.php';
            }

            if (@$_GET['page'] === 'login') {
                include 'page-login.php';
            }

        ?>

    </div>

    <?php include 'footer-2.php'; ?>

    <?php include 'modals.php'; ?>

    <script src="/js/main.js"></script>

</body>

</html>