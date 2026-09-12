  <?= view('blocks/site-top') ?>

  <?= view('header-navigation') ?>

  <?= view('header-search') ?>

  <div class="main container">

    <h1>404</h1>

    <div class="d-flex flex-column align-items-center text-center py-5">
  
      <div class="mb-4">
        <img 
          src="https://jabko.ua/image/catalog/main@2x.png;compress=true.png" 
          alt="Кіт 404" 
          class="img-fluid" 
          style="max-width: 260px;"
        >
      </div>

      <h2 class="fw-bold font-size: 40px mb-4 text-white">
        Упс, 404
      </h2>

      <div class="mb-5">
        <a href="#" class="fw-bold px-5 py-3 text-white fw-medium text-decoration-none" style="background-color: #b23b33;">
          Головна сторінка
        </a>
      </div>

      <p class="fs-4 fw-bold mb-2 text-white">
        Щось пішло не так, але ми це виправимо.
      </p>

      <p class="fs-4 fw-bold text-white">
        Виникли запитання? 
        <a href="tel:0800307775" class="text-white text-decoration-none ms-1">0 800 30 777 5</a>
      </p>

    </div>

  </div>

  <?= view('footer') ?>
  <?= view('modals') ?>

  <?php //include 'vacancies-form.php'; ?>
  
  <?= view('blocks.site-bottom') ?>

