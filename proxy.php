<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/csv');

$sheetURL = "https://docs.google.com/spreadsheets/d/e/2PACX-1vRLRnCBrA9vF7iBYoYy5auhrtM2f2xBuLngC9e9gd8uquoAdDO6W2b3eOuYBwTGLU0DkrfZIweQ4NDK/pub?gid=1&single=true&output=csv";
$data = file_get_contents($sheetURL);

echo $data;
?>
