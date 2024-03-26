<?php

namespace App\Filters;

use CodeIgniter\config\Services;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class CorsFilters implements FilterInterface
{
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        log_message('debug', 'cors');

        if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
            $origin = $_SERVER['HTTP_ORIGIN'];
        } else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $origin = $_SERVER['HTTP_REFERER'];
        } else {
            $origin = $_SERVER['REMOTE_ADDR'];
        }
        $allowed_domains = array(
            'http://localhost:4200',
            'https://exmple.com',
            'https://www.exmple.com',
        );


        if (in_array($origin, $allowed_domains)) {
            header('Access-Control-Allow-Origin: ' . $origin);
        }

        header("Access-Control-Allow-Headers: Origin, X-API-KEY, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Headers, Authorization, observe, enctype, Content-Length, X-Csrf-Token");
        header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, PATCH, OPTIONS");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 3600");
        header('content-type: application/geo+json;');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            header("HTTP/1.1 200 OK CORS");
            die();
        }
    }
}
