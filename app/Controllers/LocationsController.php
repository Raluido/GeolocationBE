<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Request;
use App\Models\Location;
use PhpParser\Node\Expr\Cast\Object_;

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
        $test = ['peep', 'asdasd'];
        log_message('error', 'asdasd', $test);
        // $model = new Location();
        // $model->save($this->request->getJSON());

        // // Respond with 201 status code
        // return $this->respondCreated();
    }
}
