<?php

if (isset($_POST["code_postal"])) {
    $code_postal=(int)$_POST["code_postal"];


    $curl = curl_init("http://api.zippopotam.us/fr/$code_postal");
    curl_setopt_array($curl,[
        CURLOPT_CAINFO         => __DIR__ . DIRECTORY_SEPARATOR . 'cert.crt',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 1
    ]);
    $data = curl_exec($curl);
    if ($data===false) {
        var_dump(curl_error($curl));
    }else {
        //On verifie que l'API ne renvoie pas un code d'erreur
        if (curl_getinfo($curl,CURLINFO_RESPONSE_CODE)===200) {
            $data = json_decode($data,true);
            $city_name = $data["places"][0]["place name"];
            $longitude = $data["places"][0]["longitude"];
            $latitude = $data["places"][0]["latitude"];
            $region = $data["places"][0]["state"];
        }else {
            //echo "Nous avons une erreur " . curl_error($curl) . " \nla reponse est : " . curl_getinfo($curl,CURLINFO_RESPONSE_CODE);
        }

    }
}
?>


<form action="" method="post">
    <label >Entrez un code postal :</label>
    <input type="number" name="code_postal" id="">
    <button type="submit">Envoyer</button>
</form>

<?php if (!isset($_POST["code_postal"])) {?>
    Tapez un code postal ...
<?php
}else { ?>
    <?php
    if (curl_getinfo($curl,CURLINFO_RESPONSE_CODE)===404) {?>
   le code postal que vous avez selectionné ne semble ne pas etre valide ...
    <?php } else { ?>
    <p>Vous avez choisi le code postal <?= $code_postal ?> </p> <br>
    <p>La ville est <?= $city_name?> dans la region <?= $region ?> et la longitude est <?= $longitude ?> et la latitude est <?= $latitude?></p>
<?php
    }
}
echo "<pre>";
var_dump($_SERVER);
echo "</pre>";

$ip = $_SERVER['REMOTE_ADDR']; // Adresse IP de l'utilisateur

$accessKey = 'e34e768fd0718314508160b12f20f3905ac2202a4a158733a0244275'; // Clé d'accès à l'API IPDATA
$apiUrl = "https://api.ipdata.co/$ip?api-key=$accessKey";
var_dump($apiUrl);

$testcurl = curl_init($apiUrl);
curl_setopt_array($testcurl,[
    CURLOPT_CAINFO         => __DIR__ . DIRECTORY_SEPARATOR . 'cert.crt',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 1
]);
$data = curl_exec($testcurl);
var_dump($data);
if ($data !== false) {
    $data = json_decode($data, true);
    if ($data !== null && isset($data['city'], $data['region_name'], $data['country_name'])) {
        $city = $data['city'];
        $region = $data['region_name'];
        $country = $data['country_name'];
        echo "L'utilisateur est localisé à $city, $region, $country.";
    } else {
        echo "Impossible de récupérer les informations de localisation.";
    }
} else {
    echo "Échec de la requête vers l'API de géolocalisation.";
}

?>
