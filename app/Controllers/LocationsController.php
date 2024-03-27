<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Request;
use PhpParser\Node\Expr\Cast\Object_;
use App\Models\Location;

class LocationsController extends ResourceController
{
    public function index()
    {
        $newModel = new Location();

        return $this->respond($this->$newModel->findAll());
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
            $point = '((';
            foreach ($coordinates as $key => $value) {
                if (count($coordinates) - 1 != $key) $point .= $value[0] . ' ' . $value[1] . ', ';
                else $point .= $value[0] . ' ' . $value[1] . '))';
            }
        } else {
            $coordinates = $geometry->coordinates;
            $point = '(';
            foreach ($coordinates as $key => $value) {
                if (count($coordinates) - 1 != $key) $point .= $value[0] . ' ' . $value[1] . ', ';
                else $point .= $value[0] . ' ' . $value[1] . ')';
            }
        }

        $data = [
            'name' => $name,
            'description' => $description,
            'location' => $type . $point
        ];

        $newModel = new Location();
        $newModel->save($data);

        // // Respond with 201 status code
        return $this->respondCreated();
    }
}
