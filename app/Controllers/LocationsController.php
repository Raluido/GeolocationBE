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
    protected $format    = 'geo+json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function create()
    {
        log_message('error', 'ahora si');

        // $model = new Location();
        // $location  = $model->save();

        // Respond with 201 status code
        return $this->respondCreated();
    }
}
