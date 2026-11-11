<?php include __DIR__ . '/../header.php'; ?>
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Admin — Items</h2>
    <div class="admin-actions">
      <a class="btn btn-outline-secondary" href="?route=home">Bekijk site</a>
      <a class="btn btn-brand" href="?route=admin_create">Nieuw item</a>
    </div>
  </div>

  <?php if (empty($items)): ?>
    <div class="alert alert-info">Geen items.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr><th>Title</th><th>Category</th><th>Created</th><th class="text-end">Actions</th></tr>
        </thead>
        <tbody>
          <?php foreach ($items as $it): ?>
            <tr>
              <td><?= htmlspecialchars($it['title']) ?></td>
              <td><?= htmlspecialchars($it['category_name'] ?? '-') ?></td>
              <td><?= htmlspecialchars($it['created_at']) ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="?route=admin_edit&id=<?= (int)$it['id'] ?>">Edit</a>
                <form method="post" action="?route=admin_delete&id=<?= (int)$it['id'] ?>" style="display:inline" onsubmit="return confirm('Verwijderen?')">
                  <?= \App\Helpers\Csrf::inputField() ?>
                  <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
