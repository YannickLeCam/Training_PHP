<?php
/**
 * Activation de CURL sur le php.ini
 */
$key = "b8005350a8dd014b721bce0f9ab80c5b";
$key2 = "b8005350a8dd01dsfsdce0f9ab80c5b"; // Fausse clé pour tester en cas d'echec
$URL = "https://api.openweathermap.org/data/2.5/weather?lat=48.5833&lon=7.75&appid=$key&units=metric&lang=fr";
$URL2 = "https://api.openweathermap.org/data/2.5/weather?lat=48.5833&lon=7.75&appid=$key2&units=metric&lang=fr";
$curl = curl_init($URL);
$curl2 =curl_init($URL2);
curl_setopt_array($curl2,[
    CURLOPT_CAINFO         => __DIR__ . DIRECTORY_SEPARATOR . 'cert.crt',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 1
]);

curl_setopt_array($curl,[
    CURLOPT_CAINFO         => __DIR__ . DIRECTORY_SEPARATOR . 'cert.crt',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 1
]);

//curl_setopt($curl , CURLOPT_CAINFO , __DIR__ . DIRECTORY_SEPARATOR . 'cert.crt');
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$data = curl_exec($curl);
$data2 = curl_exec($curl2);
if ($data===false) {
    var_dump(curl_error($curl));
}else {
    //On verifie que l'API ne renvoie pas un code d'erreur
    if (curl_getinfo($curl,CURLINFO_RESPONSE_CODE)===200) {
        $data = json_decode($data,true);
        echo "<pre>";
        $temperature = $data["main"]["temp"];
        $meteo = $data["weather"][0]["description"];
        echo "Il fait actuellement : " . $temperature . " et la météo semble etre " . $meteo;
        var_dump($data);
        echo "</pre>";
    }else {
        echo "Nous avons une erreur " . curl_error($curl) . " \nla reponse est : " . curl_getinfo($curl,CURLINFO_RESPONSE_CODE);
    }

}
/**
 * Erreur voulu pour tester le cas ou c'est pas sensé fonctionner
 */
if ($data2===false) {
    var_dump(curl_error($curl2));
}else {
    //On verifie que l'API ne renvoie pas un code d'erreur
    if (curl_getinfo($curl2,CURLINFO_RESPONSE_CODE)===200) {
        $data2 = json_decode($data2,true);
        echo "<pre>";
        $temperature = $data2["main"]["temp"];
        $meteo = $data2["weather"][0]["description"];
        echo "Il fait actuellement : " . $temperature . " et la météo semble etre " . $meteo;
        echo "</pre>";
    }else {
        echo "Cette erreur est volontaire ! </br> ";
        echo "Nous avons une erreur " . curl_error($curl2) . "</br>" ."la reponse est : " . curl_getinfo($curl2,CURLINFO_RESPONSE_CODE);
    }

}

curl_close($curl);
curl_close($curl2);
?>