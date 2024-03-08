<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class UsersController extends ResourceController
{
    protected $modelName = 'App\Models\User';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }
}
