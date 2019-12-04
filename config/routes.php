<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin('Recaptcha', ['path' => '/recaptcha'], function (RouteBuilder $routes) {
    $routes->fallbacks(DashedRoute::class);
});
