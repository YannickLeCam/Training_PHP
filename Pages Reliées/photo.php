<?php 
$identifiant=null;
    if (empty($_COOKIE["identifiant"])) {
        header("Location: profil.php");
    }else {
        $identifiant = $_COOKIE["identifiant"];
    }
?>

<?php
require("./elements/header.php");
require("./elements/navigateur.php");
?>

<?php
    echo "Bonjour " . $identifiant . " !";
?>


<?php
require("./elements/footer.php");
?>