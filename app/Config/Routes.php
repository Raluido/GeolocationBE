<?php

use CodeIgniter\Router\RouteCollection;


$routes->get('/', 'Home::index');

$routes->resource('api/users', ['controller' => 'UsersController']);
