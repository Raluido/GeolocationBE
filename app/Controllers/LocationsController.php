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
    protected $modelName = 'App\Models\Location';
    protected $format = 'json';
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $page = $this->request->getUri()->getSegment(3);
        $offset = ($page - 1) * 5;

        $query = $this->db->query(
            "WITH items AS(
                SELECT * FROM locations)        
                SELECT json_build_object(
                    'type', 'FeatureCollection',
                    'features', jsonb_agg(ST_AsGeoJSON(t.*)::json))
                FROM (
                    SELECT
                    gid,
                    name,
                    description,
                    ST_AsText(geom)::geometry,
                    COUNT(*) OVER() AS total
                    FROM 
                    items
                    LIMIT 5 OFFSET $offset
                    ) 
                AS t(gid, name, description, geom, total);"
        );
        $results = $query->getResult();
        return $this->respond($results);
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
            'geom' => $type . $point,
        ];

        $newModel = new Location();
        $newModel->save($data);

        // // Respond with 201 status code
        return $this->respondCreated();
    }
}
