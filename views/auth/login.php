<h1 class="title-page">Login</h1>
<p class="description-page">Log in to your account</p>

<form class="form" method="post" action="/">
  <div class="field">
    <label for="email" class="label">Email</label>
    <input
      type="email"
      name="email"
      id="email"
      class="input"
      placeholder="Email"
      required
    >
  </div>
  <div class="field">
    <label for="password" class="label">Password</label>
    <input
      type="password"
      name="pasword"
      id="password"
      class="input"
      placeholder="******"
      required
    >
  </div>
  <button type="submit">
    Log in
  </button>
</form>

<div class="actions">
  <a href="/register">Don't have an account? Register</a>
  <a href="/forgot-password">Forgot my password</a>
</div>