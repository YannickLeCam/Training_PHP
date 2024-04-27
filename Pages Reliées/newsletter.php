<?php
/**
 * But de ce fichier : 
 * Coté client sera un formulaire si la personne a envie de s'inscrire a la newletter le client devra insérer son adresse mail et submit
 * Coté serveur une fois le formulaire envoyer il devra vérifier si l'adresse mail est valide ou pas puis enregistrer dans un fichier en dur toute les adresse mail enregistrée
 */


function is_ValidMail ( string $mail):bool {
    $regex_mail = '/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/';
    if (preg_match($regex_mail,$mail)) {
        return true;
    }
    else {
        return false;
    }
}


function writeMailInFile( string $data ):bool{
    if (is_ValidMail($data)) {
        $fileAd = __DIR__ . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "mail_newsletter.txt";
        if (file_put_contents($fileAd,$data."\n",FILE_APPEND)>0) {
            echo "L'adresse a bien été enregistrée !";
            return true;
        }else {
            echo "Le Mail est bien valide mais il semble y avoir eu un problème lors de l'ecriture dans le fichier";
            return false;
        }
    }else {
        echo "Mail invalide ... ";
        return false;
    }
}
/**
 * Testes des fonctions mis en commentaire pour ne pas gèner la génération de la page html
 *
echo "TESTE 1\n";
var_dump(writeMailInFile("coucou"));
echo "TESTE 2\n";
var_dump(writeMailInFile("coucou@gefsefds.ds"));
*/

require("./header.php");
require("./navigateur.php");
?>

<h1>Newsletter</h1>

<?php
    if (isset($_POST["mailnewsletter"])) {
        if (writeMailInFile(html_entity_decode($_POST["mailnewsletter"]))) {
            echo "<p> Votre inscription est un succès </p>";
        }else {
            echo "<p> Malheureusement votre inscription a échoué ... </p>";
        }
    }else {
        echo "<p>Voulez-vous vous inscrire a notre Newsletter ?</p>";
    }
?>
<form action="./newsletter.php" method="post">
    <input type="text" name="mailnewsletter" id="mailnewsletter" placeholder = "Entrez votre adresse mail ici . . . ">
    <button type="submit">Inscription</button>
</form>

<?php
require("./footer.php");
?>

