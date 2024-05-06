<?php
require("./elements/header.php");
require("./elements/navigateur.php");

require_once("./Env.php");

$affichage=null;
$Date_now =New DateTimeImmutable ();
date_default_timezone_set('Europe/Paris');

function isOpen(Array $tableau_horraire):bool{
    $retour = false;
    $date= getdate();
    $detect_jour = $date["wday"]-1;
    $detect_heure = $date["hours"];

    switch ($detect_jour) {
        case 0:
            $detect_jour = "Lundi";
            break;
        case 1:
            $detect_jour = "Mardi";
            break;
        case 2:
            $detect_jour = "Mercredi";
            break;
        case 3:
            $detect_jour = "Jeudi";
            break;
        case 3:
            $detect_jour = "Vendredi";
            break;
        case 3:
            $detect_jour = "Samedi";
            break;
        case 3:
            $detect_jour = "Dimanche";
            break;
        default:
            $detect_jour = "Lundi";
            break;
    }
    foreach($tableau_horraire[$detect_jour] as $plage_ouverture ){
        if ($detect_heure > $plage_ouverture[0] && $detect_heure < $plage_ouverture[1]) {
            $retour = true;
        }
    }
    return $retour;
}

function crenneauToHtml(Array $tableau_horraire):string {
    $detect_jour = getdate();
    $detect_jour = $detect_jour["wday"]-1;
    $retour = "<ul>\n";
    foreach($tableau_horraire as $day => $horraires){
        if ($detect_jour===0) {
            $retour .= "<strong>";
        }
        if (empty($horraires)) {
            if ($detect_jour===0) {
                $retour .= "<li style =\"color:red;\"> $day nous somme fermé ";
            }else {
                $retour .= "<li> $day nous somme fermé ";
            }
        }
        else {
            if ($detect_jour===0) {
                if (isOpen(CRENNEAU)) {
                    $retour.= "<li style =\"color:lightgreen;\"> $day de ";
                }else {
                    $retour.= "<li style =\"color:red;\"> $day de ";
                }
                
            }else {
                $retour.= "<li> $day de ";
            }
            foreach($horraires as $i => $theure ){
                if ($i!==0) {
                    $retour.= " et de ";
                }
                foreach($theure as $j =>$heure ){
                    if ($j !== 0) {
                        $retour .= " à ";
                    }
                    $retour.= (string)$heure;
                }
            }
        }
        $retour.= "</li> \n";
        if ($detect_jour===0) {
            $retour .= "</strong>";
        }
        $detect_jour--;
    }
    $retour .= "</ul>\n";
    return $retour;
}




?>

<h2>Créneaux d'ouverture</h2>
<p>Le but est de donner des horraires d'ouverture et selon l'heure qu'il est </p>
<h3>Nos horraires d'ouvertures</h3>
<pre>
    <?php
        echo crenneauToHtml(CRENNEAU);
        echo date('l');
        var_dump(getdate());
        var_dump(isOpen(CRENNEAU));
    ?>
</pre>



<?php
require("./elements/footer.php");
?>