<?php
/**
 * Activation de CURL sur le php.ini
 */
$key = "b8005350a8dd014b721bce0f9ab80c5b";
$lon = "-84.0832646";
$lat = "37.1289771";
$URL = "https://api.openweathermap.org/data/2.5/weather?lat=44.34&lon=10.99&appid=$key";
$curl = curl_init($URL);
curl_setopt($curl , CURLOPT_CAINFO , __DIR__ . DIRECTORY_SEPARATOR . 'cert.crt');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($curl);
if ($data===false) {
    var_dump(curl_error($curl));
}else {
    $data = json_decode($data,true);
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

curl_close($curl);

//curl_setopt($curl, CURLOPT_URL, "https://api.predicthq.com/v1/events/"); // URL à laquelle envoyer la requête

//var_dump($curl);

?>