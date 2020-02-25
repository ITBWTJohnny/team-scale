<?php

$collection = $container->get('routerCollection');

$collection->addRoute('GET', '/', 'App\Controllers\MainController@form');

$collection->addRoute('POST', '/import', 'App\Controllers\MainController@import');

$collection->addRoute('GET', '/statistics', 'App\Controllers\MainController@statistics');