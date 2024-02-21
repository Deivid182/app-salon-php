<h1 class="title-page">Admin dashboard</h1>

<?php include_once __DIR__ . '/../templates/bar.php'; ?>
<h2>Search</h2>
<div class="search">
  <form class="form" action="">
    <div class="field">
      <label for="date">Date</label>
      <input type="date" name="date" id="date" value="<?php echo $currentDate; ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
    </div>
  </form>
</div>

<div id="list-appointments">
  <ul class="appointments">
    <?php
    $processedAppointments = [];
    foreach ($appointments as $appointment) {
      if (!isset($processedAppointments[$appointment->id])) {
        $processedAppointments[$appointment->id] = true;
        $totalPrice =  0; // Initialize total price for each appointment
    ?>
        <li>
          <p>ID: <span><?php echo $appointment->id; ?></span></p>
          <p>Time: <span><?php echo $appointment->time; ?></span></p>
          <p>Name: <span><?php echo $appointment->fullname; ?></span></p>
          <p>Email: <span><?php echo $appointment->email; ?></span></p>
          <p>Phone: <span><?php echo $appointment->phone; ?></span></p>
          <h3>Services</h3>
          <?php
          foreach ($appointments as $serviceAppointment) {
            if ($serviceAppointment->id === $appointment->id) {
              $totalPrice += $serviceAppointment->price; // Add service price to total
          ?>
              <p class="service"><?php echo $serviceAppointment->service . ' - ' . $serviceAppointment->price; ?></p>
          <?php
            }
          }
          ?>
          <p>Total: <span><?php echo $totalPrice; ?></span></p> <!-- Display total price for the appointment -->
          <form action="/api/delete" method="POST">
            <input type="hidden" name="id" value="<?php echo $appointment->id; ?>">
            <input type="submit" value="Delete" class="btn-delete">
          </form>
        </li>
    <?php
      }
    }
    ?>
  </ul>
</div>

<?php
  $script = "
    <script src='build/js/search.js'></script>
  ";
?>