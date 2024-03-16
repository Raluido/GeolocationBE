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
        $model = new Location();
        $user  = $model->save($this->request->getJSON());

        // Respond with 201 status code
        return $this->respondCreated();
    }
}
