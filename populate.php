<?php

require 'DatabaseConnector.php';
require 'Post.php';

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

$response_decoded = json_decode($response, true);

/*
 * populate db
 */
$database_connector = new DatabaseConnector();
$db_connection = $database_connector->getConnection();
$post = new Post($db_connection);
foreach ($response_decoded['data']['children'] as $post_item) {
    $post->insert($post_item['data']);
}
