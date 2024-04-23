<?php
require("./header.php");
require("./navigateur.php");

$parfum = [
    "Fraise" => 4,
    "Violette" => 5,
    "Citron" => 3,
    "Chocolat" => 2
];

$type_glace = [
    "Pot" => 3,
    "Cornet" => 2
];

$suplement = [
    "Pépites de chocolat" => 3,
    "Chantilly" => 1,
    "Nappage chocolat" => 2
];

function set_checkbox ( $tableau , string $type ) : string {
    $retour="";
    $checked = "";
    foreach ($tableau as $key => $value){
        if (isset($_POST[$type])) {
            foreach($_POST[$type] as $selected){
                if ($selected===$key) {
                    $checked="checked";
                }
            }
        }
        $retour .= <<<HT
        <input type="checkbox" name="{$type}[]" value="$key" $checked> $key $value € <br />
HT;
        $checked="";
    }
    return $retour;
}

function set_radio ( $tableau , string $type ) : string {
    $retour="";
    $checked = "";
    foreach ($tableau as $key => $value){
        if (isset($_POST[$type])) {
            foreach($_POST[$type] as $selected){
                if ($selected===$key) {
                    $checked="checked";
                }
            }
        }
        $retour .= <<<HT
        <input type="radio" name="{$type}[]" value="$key" $checked> $key $value € <br />
HT;
        $checked="";
    }
    return $retour;
}


?>
<h2>Bienvenue au glacier</h2>
<p>Vous pouvez concevoir votre glace et on vous diras le prix</p>

<form action="/Glacier.php" method="POST">
    <h4>Faite votre Glace</h4>
    <h3>Quels parfum vous faut-il ?</h3>
    <?php 
        echo set_checkbox($parfum , "parfum");
    ?>
    <h3>Quels serra le format de votre glace ?</h3>
    <?php 
        echo set_radio($type_glace , "type_glace");
    ?>
    <h3>Voulez-vous des suppléments ?</h3>
    <?php 
        echo set_checkbox($suplement , "suplement");
    ?>
    <button type="submit">Faire un devis</button>
</form>

<pre>
    <?php
        if(isset($_POST)){
            $somme =0;
            foreach($_POST["parfum"] as $type){
                foreach($parfum as $gout => $prix){
                    if ($type == $gout) {
                        $somme += $prix;
                        break;
                    }
                }
            }
            foreach($_POST["type_glace"] as $type){
                foreach($type_glace as $genre => $prix){
                    if ($type == $genre) {
                        $somme += $prix;
                        break;
                    }
                }
            }
            //On doit en faire 2 fonctions pour que ca soit propre une qui execute le foreach et une qui somme les foreach 
            //De plus vérifié que les tableaux existent bien avant ...
            foreach($_POST["suplement"] as $type){
                foreach($suplement as $sup => $prix){
                    if ($type == $sup) {
                        $somme += $prix;
                        break;
                    }
                }
            }
            echo $somme;
        }else {
            echo "En attente de votre commande ...";
        }
    ?>

</pre>


<pre>
    <?php
        var_dump($_POST);
    ?>
</pre>





<?php
require("./footer.php");

?>