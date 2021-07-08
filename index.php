<?php

require 'DatabaseConnector.php';
require 'PostGateway.php';

/*
 * consult and get data from reddit app
 */

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_HTTPHEADER => array("Content-Type: application/json"),
    CURLOPT_URL => "https://api.reddit.com/r/artificial/hot",
    CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
    CURLOPT_RETURNTRANSFER => 1
]);

$response = curl_exec($curl);

curl_close($curl);

/*
 * generate an array from json
 */
$response_decoded = json_decode($response, true);

echo '<pre>';
print_r($response_decoded['data']['children']);
echo '</pre>';

$database_connector = new DatabaseConnector();
$db_connection = $database_connector->getConnection();
$post_gateway = new PostGateway($db_connection);

/*
 * populate db
 * 
foreach ($response_decoded['data']['children'] as $post_item) {
    $post_gateway->insert($post_item['data']);
}
 */

//echo var_dump($post_gateway->find(1));