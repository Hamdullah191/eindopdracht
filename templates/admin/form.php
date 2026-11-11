<?php include __DIR__ . '/../header.php'; ?>
<?php
// Zorg dat alle variabelen bestaan
$item = $item ?? null;
$old = $old ?? [];
$errors = $errors ?? [];
$categories = $categories ?? [];

$isEdit = !empty($item);

$titleVal = $old['title'] ?? $item['title'] ?? '';
$contentVal = $old['content'] ?? $item['content'] ?? '';
$categoryVal = $old['category_id'] ?? $item['category_id'] ?? '';

if ($isEdit) {
    // Bewerken
    $action = '?route=admin_update&id=' . (int)$item['id'];
    $heading = 'Edit item';
} else {
    // Nieuw item
    $action = '?route=admin_store';
    $heading = 'Create item';
}
?>
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0"><?= $heading ?></h2>
    <a class="btn btn-outline-secondary" href="?route=admin">Terug</a>
  </div>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post" action="<?= $action ?>">
    <?= \App\Helpers\Csrf::inputField() ?>

    <div class="mb-3">
      <label class="form-label">Title</label>
      <input class="form-control" type="text" name="title" value="<?= htmlspecialchars($titleVal ?? '') ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <select class="form-select" name="category_id">
        <option value="">— none —</option>
        <?php foreach ($categories as $c): ?>
          <option value="<?= (int)$c['id'] ?>" <?= ((string)$c['id'] === (string)($categoryVal ?? '')) ? 'selected' : '' ?>><?= htmlspecialchars($c['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Content</label>
      <textarea class="form-control" name="content" rows="10" required><?= htmlspecialchars($contentVal ?? '') ?></textarea>
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-brand" type="submit">Save</button>
      <a class="btn btn-outline-secondary" href="?route=admin">Cancel</a>
    </div>
  </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
