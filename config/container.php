<?php

use Psr\Container\ContainerInterface;
use FastRoute\Dispatcher\GroupCountBased as router;
use FastRoute\DataGenerator\GroupCountBased;

return [
    FastRoute\RouteCollector::class => function (ContainerInterface $c) {
        return new \FastRoute\RouteCollector($c->get(FastRoute\RouteParser\Std::class), $c->get(FastRoute\DataGenerator\GroupCountBased::class));
    },
    FastRoute\Dispatcher\GroupCountBased::class => function (ContainerInterface $c) {
        $collector = $c->get(FastRoute\RouteCollector::class);
        return new router($collector->getData());
    },

];