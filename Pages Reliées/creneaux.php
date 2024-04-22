<?php
require("./header.php");
require("./navigateur.php");

$affichage=null;
$Date_now =New DateTimeImmutable ();

/**
if (isset($_GET["horraire_ouverture"])&&$_GET["horraire_fermeture"]) {
    if ($_GET["horraire_ouverture"]<$_GET["horraire_fermeture"]) {
        $affichage="Les horraires ne sont pas compatibles";
    }else {
        if () {
            # code...
        }
    }
}
*/
?>

<h2>Créneaux d'ouverture</h2>
<p>Le but est de donner des horraires d'ouverture et selon l'heure qu'il est </p>
<pre>
    <?php
        var_dump($Date_now);
        var_dump(DateTime::createFromImmutable( $Date_now ));
    ?>
</pre>

<form action="./creneaux.php" method="GET">
    <input type="number" name="horraire_ouverture" placeholder="Horraire d'ouverture">
    <input type="number" name="horraire_fermeture" placeholder="Horraire de fermeture">
    <button type="submit">Ajouter un horraire</button>
</form>

<?php
require("./footer.php");
?>