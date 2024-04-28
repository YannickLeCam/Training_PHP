<?php 
$identifiant=null;
    if (empty($_COOKIE["identifiant"])) {
        header("Location: profil.php");
    }else {
        $identifiant = $_COOKIE["identifiant"];
    }
?>

<?php
require("./header.php");
require("./navigateur.php");
?>

<?php
    echo "Bonjour " . $identifiant . " !";
?>


<?php
require("./footer.php");
?>