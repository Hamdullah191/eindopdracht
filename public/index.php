<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\FrontController;
use App\Controller\AdminController;
use App\Controller\AuthController;
use App\Model\User;

$route = $_GET['route'] ?? 'home';

$front = new FrontController();
$admin = new AdminController();
$auth = new AuthController();

// Simple auth guard for admin routes
$adminRoutes = ['admin', 'admin_create', 'admin_store', 'admin_edit', 'admin_update', 'admin_delete'];
if (in_array($route, $adminRoutes) && !User::isLoggedIn()) {
    header('Location: ?route=login');
    exit;
}

switch ($route) {
    case 'home':
        $front->home();
        break;
    case 'item':
        $front->detail($_GET['id'] ?? 0);
        break;

    // Auth
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->login($_POST);
        } else {
            $auth->loginForm();
        }
        break;
    case 'logout':
        $auth->logout();
        break;

    // Admin
    case 'admin':
        $admin->dashboard();
        break;
    case 'admin_create':
        $admin->createForm();
        break;
    case 'admin_store':
        $admin->create($_POST);
        break;
    case 'admin_edit':
        $admin->editForm($_GET['id'] ?? 0);
        break;
    case 'admin_update':
        $admin->update($_GET['id'] ?? 0, $_POST);
        break;
    case 'admin_delete':
        $admin->delete($_GET['id'] ?? 0, $_POST);
        break;

    default:
        http_response_code(404);
        include __DIR__ . '/../templates/404.php';
}
