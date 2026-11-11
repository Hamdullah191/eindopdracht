<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reparaties</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Optional: Google font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:#f6f8fb; }
    .site-header { background: #fff; box-shadow: 0 2px 6px rgba(16,24,40,.04); }
    .card-rounded { border-radius: 12px; }
    .btn-brand { background: #0069ff; color: #fff; border: none; }
    .muted { color:#6b7280; }
    .admin-actions { display:flex; gap:.5rem; align-items:center; }
    main { padding: 2rem 1rem; max-width:1100px; margin:0 auto; }
  </style>
</head>
<body>
<header class="site-header mb-4">
  <nav class="navbar navbar-expand-lg navbar-light container">
    <a class="navbar-brand d-flex align-items-center" href="?route=home">
      <strong>Reparaties</strong>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="?route=home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="?route=admin">Admin</a></li>
        <?php if (\App\Model\User::isLoggedIn()): ?>
          <li class="nav-item"><a class="nav-link" href="?route=logout">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="?route=login">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</header>
<main>
