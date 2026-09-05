<?php

$alertMessage = flash_get('success');

?>
<h1>Profile page</h1>

<form method="POST" class="profile-form">

  <h2 class="form-title">Profile form</h2>

  <?php if ($alertMessage): ?>
      <div class="alert alert-success" role="alert">
          <?= $alertMessage ?>
      </div>
  <?php endif; ?>

  <div class="">
    <input 
      type="text" 
      class="form-control" 
      name="name" 
      value="<?= session_get('name', ''); ?>"
      placeholder="Enter you name">
  </div>

  <div class="">
    <input 
      type="email" 
      class="form-control" 
      name="email" 
      value="<?= session_get('email', ''); ?>"
      placeholder="Enter you email">
  </div>

  <div class="mb-3">
    <input 
      type="tel" 
      class="form-control" 
      name="phone" 
      value="<?= session_get('phone', ''); ?>"
      placeholder="Enter you phone">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>

</form>