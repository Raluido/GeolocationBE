<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Request;
use App\Models\Location;
use PgSql\Connection;

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
        log_message('error', 'holi');
        // $model = new Location();
        // $locations  = $model->save($this->request->getJSON());


        // die();

        // $geojson = file_get_contents("o/1.geojson");
        // $features = json_decode($geojson, TRUE)->features;
        // $connection = pg_connect(...);
        // foreach ($features as $feature) {
        //     $layer = $feature->properties["Layer"];
        //     $subClasses = $feature->properties["SubClasses"];
        //     $geomJson = json_encode($feature->geometry);
        //     $sql = "insert into mytable (layer, subclasses, ...., geom) values ('" . $layer . "','" . $subClasses . "',..., st_geomfromgeojson('" . $geomJson . "')";
        //     pg_query($connection, $sql);
        // }

        // Respond with 201 status code
        return $this->respondCreated();
    }
}
