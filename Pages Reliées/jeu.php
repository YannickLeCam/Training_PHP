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
require("./elements/header.php");
require("./elements/navigateur.php");
?>

<form action="/jeu.php" method="GET">
    <input type="number" name="proposition" id="proposition" placeholder="Devine le nombre !" value = <?= htmlentities($_GET["proposition"])?>>
    <button type="submit">Soumettre la proposition</button>
</form>

<pre>
    <?php 
    //HTMLentities permet de traduire les objets "texte" que l'utilisateur transmet pour ne pas pouvoir manipuler du PHP ou JS comme il le souhaite
    //NEVER TRUST USERS !!! 
        if ((int)$_GET["proposition"]!= 0) {
            echo 'Vous avez essayé le nombre :' . htmlentities($_GET["proposition"]) . "\n" ;
            echo hintClient(htmlentities($_GET["proposition"]),$aDeviner) . "\n";
        }else {
            echo "Vous devez soumettre un nombre pour avoir un indice ! \n";
        }
    ?>
</pre>

<?php
require("./elements/footer.php");
?>