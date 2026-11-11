<?php
namespace App\Model;

use App\Model\Database;
use PDO;

class Category {

    public static function all(): array {
        $pdo = Database::get();
        $stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array {
        $pdo = Database::get();
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function create(string $name, string $slug): bool {
        $pdo = Database::get();
        $stmt = $pdo->prepare("INSERT INTO categories (name, slug) VALUES (:name, :slug)");
        return $stmt->execute(['name' => $name, 'slug' => $slug]);
    }
}
