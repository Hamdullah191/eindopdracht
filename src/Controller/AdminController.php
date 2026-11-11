<?php
namespace App\Controller;

use App\Model\Item;
use App\Model\Category;
use App\Helpers\Csrf;
use App\Helpers\Validation;

class AdminController {

    public function dashboard() {
        $items = Item::all();
        include __DIR__ . '/../../templates/admin/list.php';
    }

    public function createForm(array $errors = [], array $old = []) {
        $categories = Category::all();
        include __DIR__ . '/../../templates/admin/form.php';
    }

    public function create(array $post) {
        if (!Csrf::validate($post['csrf_token'] ?? null)) {
            die('Invalid CSRF token');
        }
        $validation = Validation::validateItem($post);
        if (!$validation['ok']) {
            return $this->createForm($validation['errors'], $post);
        }
        $slug = Validation::slugify($post['title']);
        Item::create([
            'title' => $post['title'],
            'slug' => $slug,
            'content' => $post['content'],
            'category_id' => $post['category_id'] ?? null
        ]);
        header('Location: ?route=admin');
        exit;
    }

    public function editForm($id, array $errors = [], array $old = []) {
        $item = Item::find((int)$id);
        if (!$item) { http_response_code(404); include __DIR__ . '/../../templates/404.php'; return; }
        $categories = Category::all();
        include __DIR__ . '/../../templates/admin/form.php';
    }

    public function update($id, array $post) {
        if (!Csrf::validate($post['csrf_token'] ?? null)) {
            die('Invalid CSRF token');
        }
        $validation = Validation::validateItem($post);
        if (!$validation['ok']) {
            return $this->editForm($id, $validation['errors'], $post);
        }
        $slug = Validation::slugify($post['title']);
        Item::update((int)$id, [
            'title' => $post['title'],
            'slug' => $slug,
            'content' => $post['content'],
            'category_id' => $post['category_id'] ?? null
        ]);
        header('Location: ?route=admin');
        exit;
    }

    public function delete($id, array $post) {
        if (!Csrf::validate($post['csrf_token'] ?? null)) {
            die('Invalid CSRF token');
        }
        Item::delete((int)$id);
        header('Location: ?route=admin');
        exit;
    }
}
