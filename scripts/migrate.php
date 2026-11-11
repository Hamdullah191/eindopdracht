<?php

// Zelfde pad als Database.php
$dbPath = realpath(__DIR__ . '/../database') . '/database.sqlite';

$pdo = new PDO("sqlite:" . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Schema laden
$sql = file_get_contents(__DIR__ . '/../database/schema.sql');
$pdo->exec($sql);

echo "Database migrated.\n";
