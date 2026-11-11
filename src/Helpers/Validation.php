<?php
namespace App\Helpers;

class Validation {
    public static function validateItem(array $data): array {
        $errors = [];
        $title = trim($data['title'] ?? '');
        $content = trim($data['content'] ?? '');
        if ($title === '') $errors['title'] = 'Title is required';
        if (strlen($title) < 3) $errors['title'] = 'Title must be at least 3 characters';
        if ($content === '') $errors['content'] = 'Content is required';
        return ['ok' => empty($errors), 'errors' => $errors];
    }

    public static function slugify(string $text): string {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text)) return 'n-a';
        return $text;
    }
}
