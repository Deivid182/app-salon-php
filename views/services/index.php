<h1 class="title-page">Services</h1>
<p class="description-page">Manage your services</p>

<?php
  include_once __DIR__ . '/../templates/bar.php';
?>

<ul class="services">
  <?php foreach($services as $service) { ?>

    <li>
      <p>Name: <span><?= $service->name ?></span></p>
      <p>Price: <span><?= $service->price ?></span></p>
      <div class="actions">
        <a href="/services/edit?id=<?php echo $service->id;?>" class="btn">Edit</a>
        <form action="/services/delete" method="post" class="delete-form">
          <input type="hidden" value="<?php echo $service->id; ?>" name="id">
          <input type="submit" value="Delete" class="btn-delete">
        </form>
      </div>
    </li>

  <?php } ?>
</ul>