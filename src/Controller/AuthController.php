<?php
namespace App\Controller;

use App\Model\User;
use App\Helpers\Csrf;

class AuthController {

    public function loginForm($error = '') {
        include __DIR__ . '/../../templates/login.php';
    }

    public function login(array $post) {
        if (!Csrf::validate($post['csrf_token'] ?? null)) {
            die('Invalid CSRF token');
        }
        $username = $post['username'] ?? '';
        $password = $post['password'] ?? '';
        if (User::authenticate($username, $password)) {
            header('Location: ?route=admin');
            exit;
        } else {
            $this->loginForm('Invalid credentials');
        }
    }

    public function logout() {
        User::logout();
        header('Location: ?route=home');
        exit;
    }
}
