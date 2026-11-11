<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Model\User;

$ok = User::authenticate('testuser', 'wrongpass');
if ($ok) { echo "FAIL: wrong password should not authenticate\n"; exit(1); }

$ok = User::authenticate('testuser', 'test123');
if (!$ok) { echo "FAIL: correct password should authenticate\n"; exit(1); }

echo "Login tests passed\n";
