<?php
namespace App\Model;

use App\Model\Database;
use PDO;

class Item {

    public static function search($keyword) {
    $db = Database::get();

    $stmt = $db->prepare("
        SELECT items.*, categories.name AS category_name
        FROM items
        LEFT JOIN categories 
        ON categories.id = items.category_id
        WHERE items.title LIKE :keyword
    ");

    $stmt->execute([
        'keyword' => '%' . $keyword . '%'
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function all(): array {
        $pdo = Database::get();
        $stmt = $pdo->query("SELECT items.*, categories.name AS category_name FROM items LEFT JOIN categories ON items.category_id = categories.id ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array {
        $pdo = Database::get();
        $stmt = $pdo->prepare("SELECT items.*, categories.name AS category_name FROM items LEFT JOIN categories ON items.category_id = categories.id WHERE items.id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function create(array $data): bool {
        $pdo = Database::get();
        $stmt = $pdo->prepare("INSERT INTO items (title, slug, content, category_id, created_at) VALUES (:title, :slug, :content, :category_id, :created_at)");
        return $stmt->execute([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'category_id' => $data['category_id'] ?: null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public static function update(int $id, array $data): bool {
        $pdo = Database::get();
        $stmt = $pdo->prepare("UPDATE items SET title = :title, slug = :slug, content = :content, category_id = :category_id, updated_at = :updated_at WHERE id = :id");
        return $stmt->execute([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'category_id' => $data['category_id'] ?: null,
            'updated_at' => date('Y-m-d H:i:s'),
            'id' => $id
        ]);
    }

    public static function delete(int $id): bool {
        $pdo = Database::get();
        $stmt = $pdo->prepare("DELETE FROM items WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function findBySlug(string $slug): ?array {
        $pdo = Database::get();
        $stmt = $pdo->prepare("SELECT * FROM items WHERE slug = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
}
