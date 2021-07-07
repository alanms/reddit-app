<?php

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_HTTPHEADER => array("Content-Type: application/json"),
    CURLOPT_URL => "https://api.reddit.com/r/artificial/hot",
    CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
    CURLOPT_RETURNTRANSFER => 1
]);

$response = curl_exec($curl);

curl_close($curl);

echo $response;

?>