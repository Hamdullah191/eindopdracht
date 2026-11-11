<?php
namespace App\Model;

use PDO;

class Database {
    private static ?PDO $pdo = null;

    public static function get(): PDO {
        if (self::$pdo === null) {
            
            // Altijd absolute pad veilig bepalen
            $baseDir = realpath(__DIR__ . '/../../');
            $path = $baseDir . '/database/database.sqlite';

            // Zorg dat de map bestaat
            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            $dsn = 'sqlite:' . $path;

            self::$pdo = new PDO($dsn);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
