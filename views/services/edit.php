<h1 class="title-page">Update service</h1>
<p class="description-page">Fill the form to update the service</p>

<?php
  include_once __DIR__ . '/../templates/bar.php';
  include_once __DIR__ . '/../templates/alerts.php';
?>

<form class="form" method="POST">
  
  <?php include_once __DIR__ . '/form.php'; ?>
  <input type="submit" value="Create" class="btn">
</form>