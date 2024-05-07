<?php
require_once("./fonction/fnct_connexion.php");
if (!empty($_POST["login-email"]) & !empty($_POST["login-password"])) {
    if (!login($_POST["login-email"],$_POST["login-password"])){
        echo "Mot de passe et/ou adresse mail semble etre incorrecte";
    }
}

if (!empty($_SESSION)) {
    header("Location: profil.php");
}

require("./elements/header.php");
require("./elements/navigateur.php");



require("./elements/login.php");
/**
 * Dans cette partie nous allons faire en sorte de connecter ou géré l'inscription de chaque clients 
 * quand le client se connect cela va ouvrir une session avec l'utilisateur
 * Une fois connecter l'utilisateur est soit un 1 admin ou juste une personne connecté 
 * si la personne est admin alors il aura accès au dashboard sinon le dashboard sera camouflé
 * quand la personne serra connecter il aura accès a la page profil avec tout les informations renseigné nous allons essayer de faire en sorte que les informations puisse etre modifiable cependant pas encore de BDD donc faire en sorte de faire ca dans un fichier pour l'instant ... 
 * Bien modifier les pages profil et dashboard pour rediriger a la connexion ou signaler un message d'erreur sur le fait que la personne n'y ai pas l'accès (en cas de forcing)
 */


var_dump($_POST , $_SESSION);

?>
<link rel="stylesheet" href="./style/login.css">




<script src="./js/login.js"></script>
<?php
require("./elements/footer.php");
?>