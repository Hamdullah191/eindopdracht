<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($item['title']) ?></title>
</head>
<body>

<h1><?= htmlspecialchars($item['title']) ?></h1>
<p><?= nl2br(htmlspecialchars($item['content'])) ?></p>
<a href="?route=home">← terug</a>

</body>
</html>
