<?php
// changing the timezone to ours
date_default_timezone_set('America/Toronto');
// pulling the data from the index.html form into a variable
$truck = $_POST['truck'];
// $truck = "12140";

// API Pull
$truckArray = array();
error_reporting(1);
$trucks = "1 -" . $truck;
$searchCriteria = "{\"vehicleName\": \"" . $trucks . "\"}";

$division = '******';
$apiKey = '******';
$url = '******' . $division . '******';
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
$headers[] = 'X-Apikey: ' . $apiKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $searchCriteria);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$jsonExec = curl_exec($ch);
if(curl_errno($ch))
{
	echo 'Error:' . curl_error($ch);
}

curl_close($ch);

$json = json_decode($jsonExec, true);
$length = count($json['Data'], 0);
echo $length . " trucks are online!\n";


header("Location: https://google.com/maps/search/" . $json['Data'][0]['lat'] . ",+" . $json['Data'][0]['lon']);
exit();
?>