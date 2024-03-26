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
    protected $locationModel = 'App\Models\Location';
    protected $format    = 'geo+json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function create()
    {
        $locationsObj = $this->request->getJSON();
        $properties = $locationsObj->features[0]->properties;
        $geometry = $locationsObj->features[0]->geometry;

        $name = (string)$properties->name;
        $description = (string)$properties->description;
        $type = $geometry->type;
        $coordinates = $geometry->coordinates;

        if ($type == 'Point') {
            $point = '(' . $coordinates[0] . ' ' . $coordinates[1] . ')';
        } else if ($type == 'Polygon') {
            $coordinates = $geometry->coordinates[0];
            $point = '(';
            foreach ($coordinates as $key => $value) {
                if (count($coordinates) - 1 != $key) $point .= $value[0] . ' ' . $value[1] . ', ';
                else $point .= $value[0] . ' ' . $value[1] . ')';
            }
        } else {
            $coordinates = $geometry->coordinates[0];
            $point = '(';
            foreach ($coordinates as $key => $value) {
                if (count($coordinates) - 1 != $key) $point .= $value[0] . ' ' . $value[1] . ', ';
                else $point += $value[0] . ' ' . $value[1] . ')';
            }
        }

        log_message('error', $type . $point);
        die();

        $data = [
            'name' => $name,
            'description' => $description,
            'location' => $type . $point
        ];

        $location = new Location();
        $location->save($data);

        // // Respond with 201 status code
        return $this->respondCreated();
    }
}
