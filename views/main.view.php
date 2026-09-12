<?= view('blocks.site-top') ?>

<?= view('header-navigation') ?>

<?= view('header-search') ?>

<div class="breadcrumbs-container container">
    <div class="row">
        <div class="col-md-6">
            <?= view('breadcrumbs') ?>
        </div>
        <div class="col-md-6">
            <?= if_page_the_view('category', 'blocks.sort'); ?>
        </div>
    </div>
</div>

<div class="main container">

    <h1>Home</h1>

</div>

<?= view('footer') ?>

<?= view('modals') ?>

<?= view('blocks.site-bottom') ?>
