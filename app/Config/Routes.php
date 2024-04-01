<?php

use CodeIgniter\Router\RouteCollection;


$routes->get('/', 'Home::index');

$routes->resource('api/locations', ['controller' => 'LocationsController']);
