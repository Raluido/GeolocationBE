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
        $locations  = $model->save($this->request->getJSON());

        log_message('debug', $locations);

        die();

        // $geojson = file_get_contents("o/1.geojson");
        // //Translate that into JSON-compliant array of features
        // $features = json_decode($geojson, TRUE)->features;
        // //Connect to your database
        // $connection = pg_connect(...);
        // //Iterate over features within FeatureCollection
        // foreach ($features as $feature) {
        //     //Extract necessary attributes
        //     $layer = $feature->properties["Layer"];
        //     $subClasses = $feature->properties["SubClasses"];

        //     //Extract geometry attribute as a string
        //     $geomJson = json_encode($feature->geometry);
        //     //Make up SQL-query
        //     $sql = "insert into mytable (layer, subclasses, ...., geom) values ('" . $layer . "','" . $subClasses . "',..., st_geomfromgeojson('" . $geomJson . "')";
        //     //Execute the query
        //     pg_query($connection, $sql);
        // }

        // Respond with 201 status code
        return $this->respondCreated();
    }
}
