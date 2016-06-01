<?php

use CatLab\Charon\Collections\RouteCollection;

$routes = new RouteCollection([
    'prefix' => '/api/v1/',
    'namespace' => 'Api\V1\Controllers',
    'middleware' => [ 'cors' ]
]);

$routes->group(
    [],
    function(RouteCollection $routes)
    {
        // All endpoints have these parameters
        $routes->parameters()->path('format')->enum(['json'])->describe('Output format')->default('json');

        $routes->returns()->statusCode(403)->describe('Authentication error');
        $routes->returns()->statusCode(404)->describe('Entity not found');
    }
);

return $routes;