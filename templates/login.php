<?php include __DIR__ . '/header.php'; ?>
<section>
  <h2>Login</h2>
  <?php if (!empty($error)): ?><div class="flash"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post" action="?route=login">
    <?= \App\Helpers\Csrf::inputField() ?>
    <label>Username
      <input type="text" name="username" required>
    </label>
    <label>Password
      <input type="password" name="password" required>
    </label>
    <button class="btn" type="submit">Login</button>
  </form>
</section>
<?php include __DIR__ . '/footer.php'; ?>
