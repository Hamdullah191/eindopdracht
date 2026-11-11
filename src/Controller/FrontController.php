<?php
namespace App\Controller;

use App\Model\Item;
use App\model\Category;

class FrontController {
    public function home() {
    $search = $_GET['search'] ?? '';

    if (!empty($search)) {
        $items = \App\Model\Item::search($search);
    } else {
        $items = \App\Model\Item::all();
    }

    $totalItems = count($items);

    include __DIR__ . '/../../templates/home.php';
}

    public function detail($id) {
        $item = Item::find((int)$id);
        if (!$item) {
            http_response_code(404);
            include __DIR__ . '/../../templates/404.php';
            return;
        }
        include __DIR__ . '/../../templates/detail.php';
    }
}
