<?php

$alertMessage = flash_get('success');

?>
<h1>Login page</h1>

<form method="POST" class="profile-form">

  <?php if ($alertMessage): ?>
      <div class="alert alert-success" role="alert">
          <?= $alertMessage ?>
      </div>
  <?php endif; ?>

  <div class="mb-3">
    <label class="form-label">Enter you name</label>
    <input type="text" class="form-control" name="name" value="<?= session_get('name', ''); ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Enter you email</label>
    <input type="email" class="form-control" name="email" value="<?= session_get('email', ''); ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Enter you phone</label>
    <input type="tel" class="form-control" name="phone" value="<?= session_get('phone', ''); ?>">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>

</form>