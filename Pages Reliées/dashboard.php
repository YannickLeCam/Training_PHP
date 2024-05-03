<?php
require("./header.php");
require("./navigateur.php");
require_once("./fonction/fonct_vue.php");

$nb_vue_total = nbVueMois();

$annee = (int)date('Y');
$annee_selected = empty($_GET["annee"]) ? null :(int)$_GET["annee"];
$mois_selected =empty($_GET["mois"]) ? null :(int)$_GET["mois"];
$mois = [
    "01" => "Janvier",
    "02" => "Février",
    "03" => "Mars",
    "04" => "Avril",
    "05" => "Mai",
    "06" => "Juin",
    "07" => "Juillet",
    "08" => "Août",
    "09" => "Septembre",
    "10" => "Octobre",
    "11" => "Novembre",
    "12" => "Décembre"
];
$tab_vue_mois = nbVueMois($annee_selected,$mois_selected);
?>

<div class="row">
    <div class="col-md-4">
        <div class="list-group">
            <a class="list-group-item <?= null === $annee_selected ? "active" : "" ?>" href = "dashboard.php">Total</a>
            <?php for($i = 0; $i < 5 ; $i++) : ?>
                <a class="list-group-item <?= $annee-$i === $annee_selected ? "active" : "" ?>" href = "dashboard.php?annee=<?=$annee-$i?>"><?=$annee-$i?></a>
                <?php if($annee-$i === $annee_selected) :?>
                    <?php foreach($mois as $num => $nom_mois) :?>
                        <a class="list-group-item <?= $num == $mois_selected ? "active" : "" ?>" href = "dashboard.php?annee=<?=$annee-$i?>&mois=<?=$num?>"><?=$nom_mois?></a>
                    <?php endforeach; ?>
                <?php endif ?>
            <?php endfor ?>
            </div>
    </div>
    <div class="col-md-8">
        <?php foreach($tab_vue_mois as $page => $vues) : ?>       
        <div class="card">
            <div class="card-body">
                <strong style="font-size:3em;"><?= $vues?></strong><br>
                Visite<?= $vues > 1 ? 's' : '' ?> pour <?=$page?> <?php if($annee_selected!== null) :?> en <?=$annee_selected ?> <?php endif?><?php if($mois_selected!= null) :?> en <?=$mois[str_pad($mois_selected ,2, "0", STR_PAD_LEFT)]?> <?php endif;?>
            </div>
        </div>
        <?php endforeach;?>
        
    </div>
</div>


<?php
require("./footer.php");
?>