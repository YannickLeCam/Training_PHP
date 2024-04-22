<?php 
$title = "Accueil";
require("./header.php");
?>

<?php
require("./navigateur.php");
?>


<pre>
    <?php
    //Cette partie nous montre ce que contient la variable Server considéré comme "super global" dans le serveur PHP
        print_r($_SERVER);
    ?>
</pre>

<main class="container">
  <div class="bg-body-tertiary p-5 rounded">
    <h1>Accueil</h1>
    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus quasi atque possimus iusto rerum amet rem quia dignissimos non magnam itaque maiores, quam expedita ratione dolore, asperiores sequi distinctio explicabo.</p>
  </div>
</main>

<?php require("./footer.php");?>