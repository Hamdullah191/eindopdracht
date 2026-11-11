<?php
namespace App\Model;

use App\Model\Database;
use PDO;

class User {

    public static function findByUsername(string $username): ?array {
        $pdo = Database::get();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function findById(int $id): ?array {
        $pdo = Database::get();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function authenticate(string $username, string $password): bool {
        $user = self::findByUsername($username);
        if (!$user) return false;
        if (!password_verify($password, $user['password_hash'])) return false;
        // set session
        $_SESSION['user_id'] = $user['id'];
        return true;
    }

    public static function create(string $username, string $email, string $password): bool {
        $pdo = Database::get();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, role, created_at) VALUES (:username, :email, :hash, :role, :created_at)");
        return $stmt->execute([
            'username' => $username,
            'email' => $email,
            'hash' => $hash,
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public static function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }

    public static function current(): ?array {
        if (!self::isLoggedIn()) return null;
        return self::findById((int)$_SESSION['user_id']);
    }

    public static function logout(): void {
        unset($_SESSION['user_id']);
        session_destroy();
    }
}
