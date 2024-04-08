<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\LocationsController;


$routes->get('/', 'Home::index');

$routes->get('api/locations/(:num)', 'LocationsController::index');
$routes->post('api/locations', 'LocationsController::create');
