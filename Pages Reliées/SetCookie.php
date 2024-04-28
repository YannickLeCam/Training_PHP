<?php
$identifiant = null;
if (!empty($_POST["identifiant"])) {
    setcookie("identifiant", $_POST["identifiant"]);
//    if (empty($_COOKIE["identifiant"])) {
        
//    }else {
//       $_COOKIE["identifiant"]=$_POST["identifiant"];
 //   }
}
if (!empty($_COOKIE["identifiant"])) {
    $identifiant = htmlentities($_COOKIE["identifiant"]);
}
header("Location: profil.php");
?>
