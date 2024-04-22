<?php

$aDeviner = 150;
if (!isset($_GET ["proposition"])) {
    $_GET ["proposition"]=0;
}


function hintClient(int $proposition,int $aDeviner):string {
    if ($proposition===$aDeviner) {
        return "Vous avez trouvé le bon chiffre ! Brevo !";
    }else {
        if ($proposition<$aDeviner) {
            return "C'est plus !";
        }
        else {
            return "C'est moins !";
        }
    }
}

?>

<?php
require("./header.php");
require("./navigateur.php");
?>

<form action="/jeu.php" method="GET">
    <input type="number" name="proposition" placeholder="Devine le nombre !">
    <button type="submit">Soumettre la proposition</button>
</form>

<pre>
    <?php 
        if ($_GET["proposition"]!= 0) {
            echo 'Vous avez essayé le nombre :' . $_GET["proposition"] . "\n" ;
            echo hintClient($_GET["proposition"],$aDeviner) . "\n";
        }else {
            echo "Vous devez soumettre un nombre pour avoir un indice ! \n";
        }
    ?>
</pre>

<?php
require("./footer.php");
?>