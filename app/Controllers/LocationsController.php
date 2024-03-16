<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Request;
use App\Models\Location;

class LocationsController extends ResourceController
{
    protected $modelName = 'App\Models\Location';
    protected $format    = 'json';

    public function index()
    {
        log_message('debug', 'yeahhh');
        return $this->respond($this->model->findAll());
    }

    public function create()
    {
        log_message('debug', 'yeahhh');
        log_message('debug', '', $this->request->getJSON());
    }
}
