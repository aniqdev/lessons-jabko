<footer class="container bg-black text-white">
  
  <div class="mx-auto">
    
    <div class="row align-items-start justify-content-between g-0">

      <div class="col-12 col-lg-5">
        <h3 class="footer-title">Продукція</h3>
        <div class="d-flex justify-content-between pe-lg-5">
          <ul class="list-unstyled footer-list">
            <li><a href="#">iPhone</a></li>
            <li><a href="#">iPad</a></li>
            <li><a href="#">Mac</a></li>
            <li><a href="#">Apple Watch</a></li>
            <li><a href="#">AirPods</a></li>
            <li><a href="#">Гаджети</a></li>
            <li><a href="#">Аксесуари</a></li>
            <li><a href="#">Apple б/у</a></li>
          </ul>
          <ul class="list-unstyled footer-list">
            <li><a href="#">Вигідно-ягідно</a></li>
            <li><a href="#">Dyson</a></li>
            <li><a href="#">Смартфони</a></li>
            <li><a href="#">Смарт-годинники</a></li>
            <li><a href="#">Техніка для кухні</a></li>
            <li><a href="#">Техніка для дому</a></li>
            <li><a href="#">Телевізори та медіа</a></li>
            <li><a href="#">Ігрова зона</a></li>
          </ul>
          <ul class="list-unstyled footer-list">
            <li><a href="#">Ноутбуки і ПК</a></li>
            <li><a href="#">Планшети та е-книги</a></li>
            <li><a href="#">Конструктори LEGO</a></li>
            <li><a href="#">Краса та здоровʼя</a></li>
            <li><a href="#">Фото та відео</a></li>
            <li><a href="#">Аудіо</a></li>
            <li><a href="#">Уцінена техніка</a></li>
          </ul>
        </div>
      </div>

      <div class="col-6 col-sm-4 col-lg-1">
        <h3 class="footer-title">Послуги</h3>
        <ul class="list-unstyled footer-list">
          <li><a href="#">Ремонт</a></li>
          <li><a href="#">Trade IN</a></li>
          <li><a href="#">Новини</a></li>
        </ul>
      </div>

      <div class="col-6 col-sm-4 col-lg-2">
        <h3 class="footer-title">Інформація</h3>
        <ul class="list-unstyled footer-list">
          <li><a href="#">Вакансії</a></li>
          <li><a href="#">Гарантія та сервіс Ябко</a></li>
          <li><a href="#">Доставка та оплата</a></li>
          <li><a href="#">Договір публічної оферти</a></li>
          <li><a href="#">Магазини</a></li>
        </ul>
      </div>

      <div class="col-12 col-sm-4 col-lg-3">
        <h3 class="footer-title text-nowrap">Для зв'язку та запитань</h3>
        
        <div class="mb-2">
          <a href="mailto:<?= session_get('email', '-'); ?>" class="footer-email"><?= session_get('email', '-'); ?></a>
          <div class="d-flex align-items-baseline gap-2 mt-1">
            <a href="tel:<?= session_get('phone', '-'); ?>" class="footer-phone text-nowrap"><?= session_get('phone', '-'); ?></a>
            <span class="footer-time text-nowrap">(з 9:00 до 22:00)</span>
          </div>
        </div>

        <div class="d-flex align-items-center gap-3 mb-3">
          <a href="#" class="soc-icon"><i class="bi bi-instagram"></i></a>
          <a href="#" class="soc-icon"><i class="bi bi-youtube"></i></a>
          <a href="#" class="soc-icon"><i class="bi bi-tiktok"></i></a>
          <a href="#" class="soc-icon"><i class="bi bi-telegram"></i></a>
          <span class="d-flex align-items-center gap-2">
            <span class="radio-dot"></span>
            <a href="#" class="radio-text">RADIO</a>
          </span>
        </div>

        <div class="d-flex gap-2">
          <span class="custom-badge">VISA</span>
          <span class="custom-badge">MasterCard</span>
          <span class="custom-badge"> Pay</span>
        </div>
      </div>

    </div>
  </div>
</footer>