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

function set_checkbox (Array $tableau , string $type ) : string {
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

function set_radio ( Array $tableau , string $type ) : string {
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

function sommepartype (string $nomTabInPost ,Array $tableau):int {
    if (isset($_POST[$nomTabInPost])) {
        $somme=0;
        foreach($_POST[$nomTabInPost] as $type){
            foreach($tableau as $sup => $prix){
                if ($type == $sup) {
                    $somme += $prix;
                    break;
                }
            }
        }
        return $somme;
    }else {
        return 0;
    }
}

function sommetotal (Array $parfum,Array $type_glace,Array $suplement):int {
    $somme=0;
    $somme += sommepartype("parfum", $parfum);
    $somme += sommepartype("type_glace", $type_glace );
    $somme += sommepartype("suplement", $suplement );
    return $somme;
}


?>
<h1>Bienvenue au glacier</h1>
<p>Vous pouvez concevoir votre glace et on vous diras le prix</p>

<form action="/Glacier.php" method="POST">
    <h2>Faite votre Glace</h2>
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
        $somme = sommetotal($parfum,$type_glace,$suplement);
        if($somme!=0){
            echo "Le total est : $somme €";
        }else {
            echo "En attente de votre commande ...";
        }
    ?>

</pre>



<h4>Vision de $_POST</h4>
<pre>
    <?php
        var_dump($_POST);
    ?>
</pre>





<?php
require("./footer.php");

?>