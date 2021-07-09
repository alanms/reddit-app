<?php

require 'DatabaseConnector.php';
require 'PostController.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$request_type = $uri[2];

$database_connector = new DatabaseConnector();
$db_connection = $database_connector->getConnection();
$controller = new PostController($db_connection);

/* 
 * all of our endpoints start with /post or /author
 * and have a defined number of parameters,
 * everything else results in a 404 Not Found
 */
$param = null;
switch ($request_type) {

    case 'post': 
        if (isset($uri[3])) {
            $param['initial_date'] = (int) $uri[3];
        } else {
            header("HTTP/1.1 404 Not Found");
            exit();
        }

        if (isset($uri[4])) {
            $param['final_date'] = (int) $uri[4];
        } else {
            header("HTTP/1.1 404 Not Found");
            exit();
        }

        // ups as default order
        if (isset($uri[5])) {
            $param['order'] = ($uri[5] == 'num_comments') ? 'num_comments' : 'ups';
        } else {
            header("HTTP/1.1 404 Not Found");
            exit();
        }
        
        $controller->processRequest('post', $param);
        
        break;

    case 'author':
        // ups as default order
        if (isset($uri[3])) {
            $param['order'] = ($uri[3] == 'num_comments') ? 'num_comments' : 'ups';
        } else {
            header("HTTP/1.1 404 Not Found");
            exit();
        }

        $controller->processRequest('author', $param);

        break;
    
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
        break;
}
