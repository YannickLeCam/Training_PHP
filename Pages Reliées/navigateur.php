<?php
/**
 * Cette fonction permet de détecter la page active grâce a la variable $SERVEUR contenant la page active dans "SCRIPT_NAME", ensuite celle-ci est comparer au adresse et disponible et renvoyant une balise adaptée avec la classe adéquate
 * ENTREE
 * * $lien => string etant le lien pour accéder a la page.
 * * $titre => permettant de d'ajouter le titre qu'il faut au navigateur.
 * RETOUR
 * * Est une balise HTML en string.
 */
function active ( string $lien , string $titre ) : string {
    //Note a moi-même : <<<HTML = écriture HEREDOC des chaines de characteres plus adapté pour y intégrer du code HTML (Pour éviter d'échapper toute les double quote)
    if ($_SERVER["SCRIPT_NAME"]==$lien) {
        return "<a class=\"nav-link active\" aria-current=\"page\" href=\"$lien\">$titre</a>";
    }else {
        return "<a class=\"nav-link\" aria-current=\"page\" href=\"$lien\">$titre</a>";
    }
}

?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php">Mon Site</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <?php echo active("/index.php", "Acceuil") ?>
        </li>
        <li class="nav-item">
          <?php echo active("/contact.php", "Contact") ?>
        <li class="nav-item">
          <?php echo active("/jeu.php", "Jeu") ?>
        <li class="nav-item">
          <?php echo active("/creneaux.php", "Créneaux") ?>
        <li class="nav-item">
          <?php echo active("/Glacier.php", "Glacier") ?>
      </ul>
    </div>
  </div>
</nav>