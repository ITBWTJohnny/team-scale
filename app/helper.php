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

if (!function_exists('redirectTo')) {
    function redirectTo($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }
}