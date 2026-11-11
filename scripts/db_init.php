<?php

// Laad Database class direct zonder Composer
require_once __DIR__ . '/../src/Model/Database.php';

use App\Model\Database;

$path = realpath(__DIR__ . '/../database') . '/database.sqlite';

if (file_exists($path)) {
    echo "Database already exists at $path\n";
    exit;
}

// Zorg dat de map bestaat
$pdo = Database::get();

$sql = <<<SQL
PRAGMA foreign_keys = ON;

CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT NOT NULL UNIQUE,
  email TEXT,
  password_hash TEXT NOT NULL,
  role TEXT DEFAULT 'user',
  created_at TEXT
);

CREATE TABLE categories (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  slug TEXT NOT NULL UNIQUE
);

CREATE TABLE items (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title TEXT NOT NULL,
  slug TEXT NOT NULL UNIQUE,
  content TEXT,
  category_id INTEGER,
  created_at TEXT,
  updated_at TEXT,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);
SQL;

$pdo->exec($sql);
echo "Tables created.\n";

// create test user
$username = 'testuser';
$email = 'test@example.com';
$password = 'test123';
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, role, created_at) VALUES (:u,:e,:h,:r,:c)");
$stmt->execute([
    'u' => $username,
    'e' => $email,
    'h' => $hash,
    'r' => 'admin',
    'c' => date('Y-m-d H:i:s')
]);
echo "Test user created: $username / $password\n";

// create sample category & item
$stmt = $pdo->prepare("INSERT INTO categories (name, slug) VALUES (:n,:s)");
$stmt->execute([
    'n' => 'General',
    's' => 'general'
]);

$catId = $pdo->lastInsertId();

$stmt = $pdo->prepare("INSERT INTO items (title, slug, content, category_id, created_at) VALUES (:t,:s,:c,:cat,:d)");
$stmt->execute([
    't' => 'Hello World',
    's' => 'hello-world',
    'c' => 'This is a sample item created during DB init.',
    'cat' => $catId,
    'd' => date('Y-m-d H:i:s')
]);

echo "Sample category and item created.\n";
echo "Done.\n";
