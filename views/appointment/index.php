<h1 class="title-page">Create a new appointment</h1>
<p class="description-page">Select your services and enter your data</p>


<div class="app">
  <div class="bar">
    <p>Hola: <?php echo $name ?? ''; ?></p>

    <a href="/logout" class="btn">
      <svg width="32px" height="32px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path d="M11.75 9.874C11.75 10.2882 12.0858 10.624 12.5 10.624C12.9142 10.624 13.25 10.2882 13.25 9.874H11.75ZM13.25 4C13.25 3.58579 12.9142 3.25 12.5 3.25C12.0858 3.25 11.75 3.58579 11.75 4H13.25ZM9.81082 6.66156C10.1878 6.48991 10.3542 6.04515 10.1826 5.66818C10.0109 5.29121 9.56615 5.12478 9.18918 5.29644L9.81082 6.66156ZM5.5 12.16L4.7499 12.1561L4.75005 12.1687L5.5 12.16ZM12.5 19L12.5086 18.25C12.5029 18.25 12.4971 18.25 12.4914 18.25L12.5 19ZM19.5 12.16L20.2501 12.1687L20.25 12.1561L19.5 12.16ZM15.8108 5.29644C15.4338 5.12478 14.9891 5.29121 14.8174 5.66818C14.6458 6.04515 14.8122 6.48991 15.1892 6.66156L15.8108 5.29644ZM13.25 9.874V4H11.75V9.874H13.25ZM9.18918 5.29644C6.49843 6.52171 4.7655 9.19951 4.75001 12.1561L6.24999 12.1639C6.26242 9.79237 7.65246 7.6444 9.81082 6.66156L9.18918 5.29644ZM4.75005 12.1687C4.79935 16.4046 8.27278 19.7986 12.5086 19.75L12.4914 18.25C9.08384 18.2892 6.28961 15.5588 6.24995 12.1513L4.75005 12.1687ZM12.4914 19.75C16.7272 19.7986 20.2007 16.4046 20.2499 12.1687L18.7501 12.1513C18.7104 15.5588 15.9162 18.2892 12.5086 18.25L12.4914 19.75ZM20.25 12.1561C20.2345 9.19951 18.5016 6.52171 15.8108 5.29644L15.1892 6.66156C17.3475 7.6444 18.7376 9.79237 18.75 12.1639L20.25 12.1561Z" fill="#000000"></path>
        </g>
      </svg>
      Sign out
    </a>
  </div>
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
      <input type="hidden" id="id" value="<?php echo $id; ?>">
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
$script = '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="build/js/app.js"></script>
  ';
?>