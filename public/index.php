<?php

$publicDir = __DIR__;
$rootDir = dirname($publicDir);

define('__ROOT__', $rootDir);

require_once($rootDir .'/vendor/autoload.php');

require_once($rootDir . '/bootstrap/bootstrap.php');
require_once($rootDir .'/config/routes.php');

$kernel = $container->get(\App\Kernel::class);
$kernel->run();
