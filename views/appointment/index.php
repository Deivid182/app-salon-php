<h1 class="title-page">Create a new appointment</h1>
<p class="description-page">Select your services and enter your data</p>

<div class="app">
  <nav class="tabs">
    <button class="active" type="button" data-step="1">
      Services
    </button>
    <button type="button" data-step="2">
      Appointment data
    </button>
    <button type="button" data-step="3">
      Summary
    </button>
  </nav>
  <div id="step-1" class="section">
    <h2>Services</h2>
    <p class="text-center">Select services below</p>
    <div id="services" class="services-list">
    </div>
  </div>
  <div id="step-2" class="section">
    <h2>Your data and time</h2>
    <p class="text-center">Enter your data and time to schedule</p>
    <form action="" class="form">
      <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" readonly>
      </div>
      <div class="field">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
      </div>
      <div class="field">
        <label for="time">Time</label>
        <input type="time" name="time" id="time">
      </div>
    </form>
  </div>
  <div id="step-3" class="section summary">
    <h2>Summary</h2>
    <p class="text-center">Review your appointment</p>
  </div>
  <div class="pagination">
    <button id="prev" class="btn" type="button">
      &laquo; Previous
    </button>
    <button id="next" class="btn" type="button">
      Next &raquo;
    </button>
  </div>
</div>
<?php
  $script = '<script src="build/js/app.js"></script>';
?>