<?php
if (!function_exists('container')) {
    function container($container = null): ?\Psr\Container\ContainerInterface
    {
        static $c = null;

        if (!empty($container)) {
            $c = $container;
        }

        return $c;
    }
}