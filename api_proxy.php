<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Replace YOUR_API_KEY with your actual API key
$apiUrl = "https://api.aprs.fi/api/get?name=VU2LWI-12&what=loc&apikey=194964.xPjRJblFC7JwIN16&format=json";

// Make the request to the external API
$response = file_get_contents($apiUrl);

// Return the response to the client
echo $response;
?>
