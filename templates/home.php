<?php include __DIR__ . '/header.php'; ?>

<form method="GET" class="mb-4">
    <input type="hidden" name="route" value="home">

    <div class="input-group">
        <input 
            type="text"
            name="search"
            class="form-control"
            placeholder="Zoek items..."
            value="<?= htmlspecialchars($search ?? '') ?>"
        >

        <button class="btn btn-primary" type="submit">
            Zoeken
        </button>
    </div>
</form>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 mb-0">Alle items</h1>
      <div class="muted">Bekijk en lees je content</div>
    </div>
    <div>
      <a class="btn btn-outline-secondary me-2" href="?route=admin">Admin</a>
      <a class="btn btn-brand" href="?route=admin_create">Nieuw item</a>
    </div>
  </div>

  <?php if (empty($items)): ?>
    <div class="alert alert-info">Er zijn nog geen items. Maak er een aan via het admin-paneel.</div>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach ($items as $item): ?>
        <div class="col-12 col-md-6 col-lg-4">
          <article class="card card-rounded h-100 shadow-sm">
            <div class="card-body d-flex flex-column">
              <h5 class="mb-1">
    <?= htmlspecialchars($item['title']) ?>
</h5>

<?php if (!empty($item['updated_at']) && $item['updated_at'] !== $item['created_at']): ?>
    <small class="text-warning">
        Bewerkt op <?= date('d-m-Y H:i', strtotime($item['updated_at'])) ?>
    </small>
<?php endif; ?>
              <p class="card-text text-truncate"><?= htmlspecialchars(substr($item['content'] ?? '', 0, 140)) ?></p>
              <div class="mt-auto d-flex justify-content-between align-items-center">
                <a href="?route=item&id=<?= (int)$item['id'] ?>" class="stretched-link">Lees meer</a>
                <small class="muted"><?= htmlspecialchars(date('Y-m-d', strtotime($item['created_at'] ?? 'now'))) ?></small>
              </div>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>
