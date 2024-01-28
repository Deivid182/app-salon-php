<h1 class="title-page">Register</h1>
<p class="description-page">Create your account</p>
<?php
  include_once __DIR__ . '/../templates/alerts.php';
?>
<form class="form" method="post" novalidate action="/register">
  <div class="field">
    <label for="first-name" class="label">First Name</label>
    <input type="text" name="firstName" id="first-name" value="<?php echo s($user->firstName); ?>" class="input" placeholder="Name" required>
  </div>
  <div class="field">
    <label for="last-name" class="label">Last Name</label>
    <input type="text" name="lastName" id="last-name" class="input" value="<?php echo s($user->lastName); ?>" placeholder="Last Name" required>
  </div>
  <div class="field">
    <label for="phone" class="label">Phone Number</label>
    <input type="tel" name="phone" id="phone" class="input" value="<?php echo s($user->phone); ?>" placeholder="Phone" required>
  </div>
  <div class="field">
    <label for="email" class="label">Email</label>
    <input type="email" name="email" id="email" class="input" value="<?php echo s($user->email); ?>" placeholder="Email" required>
  </div>
  <div class="field">
    <label for="password" class="label">Password</label>
    <input type="password" name="password" id="password" class="input" value="<?php echo s($user->password); ?>" placeholder="******" required>
  </div>
  <button class="btn" type="submit">
    Register
  </button>
</form>

<div class="actions">
  <a href="/">Already have an account? Log in</a>
  <a href="/forgot-password">Forgot my password</a>
</div>