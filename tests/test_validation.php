<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Helpers\Validation;

$res = Validation::validateItem(['title'=>'Hi','content'=>'x']);
if ($res['ok']) { echo "FAIL: short title should fail\n"; exit(1); }

$res = Validation::validateItem(['title'=>'Good title','content'=>'content here']);
if (!$res['ok']) { echo "FAIL: valid data should pass\n"; exit(1); }

echo "Validation tests passed\n";
