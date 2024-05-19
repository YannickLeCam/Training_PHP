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
?>
