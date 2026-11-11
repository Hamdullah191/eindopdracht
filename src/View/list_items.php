<?php include __DIR__ . '/header.php'; ?>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Items (lijst)</h2>
    <a class="btn btn-brand" href="?route=admin_create">Nieuw item</a>
  </div>

  <?php if (empty($items)): ?>
    <div class="alert alert-info">Geen items gevonden.</div>
  <?php else: ?>
    <div class="list-group">
      <?php foreach ($items as $it): ?>
        <a href="?route=item&id=<?= (int)$it['id'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
          <div>
            <div class="fw-semibold"><?= htmlspecialchars($it['title']) ?></div>
            <small class="muted"><?= htmlspecialchars($it['category_name'] ?? '-') ?></small>
          </div>
          <small class="muted"><?= htmlspecialchars(date('Y-m-d', strtotime($it['created_at'] ?? 'now'))) ?></small>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>
