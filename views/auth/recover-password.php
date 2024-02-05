<h1 class="title-page">Recover Password</h1>
<p class="description-page">Enter your new passoword</p>

<?php include_once __DIR__ . '/../templates/alerts.php'; ?>
<?php if($error) return; ?>
<form class="form" method="post">
  <div class="field">
    <label for="password" class="label">Password</label>
    <input
      type="password"
      name="password"
      id="password"
      class="input"
      placeholder="***********"
      required
    >
  </div>
  <button class="btn" type="submit">
    Recover
  </button>
</form>

<div class="actions">
  <a href="/">Already have an account? Log in</a>
  <a href="/register">Don't have an account? Register</a>
</div>