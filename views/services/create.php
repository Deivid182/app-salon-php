<h1 class="title-page">New Service</h1>
<p class="description-page">Fill the form to create a new service</p>

<?php
  include_once __DIR__ . '/../templates/bar.php';
  include_once __DIR__ . '/../templates/alerts.php';
?>

<form action="/services/create" class="form" method="POST">
  
  <?php include_once __DIR__ . '/form.php'; ?>
  <input type="submit" value="Create" class="btn">
</form>