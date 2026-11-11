<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
<h1>Items</h1>
<ul>
  <?php foreach ($items as $item): ?>
    <li>
      <a href="?route=item&id=<?= $item['id'] ?>">
        <?= htmlspecialchars($item['title']) ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
</body>
</html>
