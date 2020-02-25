<?php

$publicDir = __DIR__;
$rootDir = dirname($publicDir);

define('__ROOT__', $rootDir);

require_once($rootDir .'/vendor/autoload.php');
//
//$dsn = "mysql:host=localdev-mariadb;dbname=geonames";
//$user = "root";
//$passwd = "root";
//
//$pdo = new PDO($dsn, $user, $passwd);
//$data = [];
//
//$stmt = $pdo->prepare('SELECT name, continent, phone from countryinfo');
//
//$stmt->execute();
//
//$data = $stmt->fetchAll();
//$result = [];
//
//foreach ($data as $item) {
////    dd($item);
//    $phone = str_replace(['+', ' ', '-'], '', $item['phone']);
//
//    if (empty($phone)) continue;
//
//    $result[$phone] = $item['continent'];
//}
//
//
//file_put_contents(__ROOT__ .'/config/geoname.php', serialize($result));
//
//die();
//
//ob_start();


require_once($rootDir . '/bootstrap/bootstrap.php');
require_once($rootDir .'/config/routes.php');

$kernel = $container->get('kernel');
$kernel->run();
