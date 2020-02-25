<?php

use Psr\Container\ContainerInterface;
use FastRoute\Dispatcher\GroupCountBased as router;
use FastRoute\DataGenerator\GroupCountBased;

return [
    'routeParser' => new FastRoute\RouteParser\Std(),
    'dataGenerator' => new GroupCountBased(),
    'routerCollection' => function (ContainerInterface $c) {
        return new \FastRoute\RouteCollector($c->get('routeParser'), $c->get('dataGenerator'));
    },
    'router' => function (ContainerInterface $c) {
        $collector = $c->get('routerCollection');
        return new router($collector->getData());
    },
    'handler' => function (ContainerInterface $c) {
        return new \App\Http\Handler($c->get('router'), $c->get('request'), $c->get('response'));
    },
    'kernel' => function (ContainerInterface $c) {
        return new \App\Kernel($c->get('handler'));
    },
    'request' => function(ContainerInterface $c) {
        return new \App\Http\Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], \getallheaders(), $c->get('stream'), $_SERVER['SERVER_PROTOCOL']);
    },
    \App\Http\Request::class => function (ContainerInterface $c) {
        return $c->get('request');
    },
    'response' => new \App\Http\Response(),
    'stream' => new \App\Http\Stream(),
    \App\Controllers\MainController::class => function(ContainerInterface $c) {
        return new \App\Controllers\MainController($c->get('request'), $c->get('response'));
    },

];