<?php include __DIR__ . '/header.php'; ?>

<div class="container">
  <div class="mb-4">
    <a class="text-decoration-none muted" href="?route=home">&larr; Terug</a>
  </div>

  <article class="card card-rounded shadow-sm">
    <div class="card-body">
      <h1 class="h4"><?= htmlspecialchars($item['title']) ?></h1>
      <div class="muted mb-3">
        <?= htmlspecialchars($item['category_name'] ?? '—') ?> • <?= htmlspecialchars($item['created_at'] ?? '') ?>
      </div>
      <div class="mt-3"><?= nl2br(htmlspecialchars($item['content'] ?? '')) ?></div>
    </div>
  </article>
</div>

<?php include __DIR__ . '/footer.php'; ?>
