<?php
header('Content-Type: application/json');

$url = 'https://api.aprs.fi/api/get?name=VU2LWI-12&what=loc&apikey=194964.xPjRJblFC7JwIN16&format=json';
$response = file_get_contents($url);

echo $response;
?>
