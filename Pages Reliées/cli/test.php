<?php

/**
 * La constante __DIR__ permet de localiser le chemin d'accès du fichier actuel 
 * La constante DIRECTORY_SEPARATOR permet de d'ajouter un séparateur de fichier selon le systeme d'exploitation (Windows = \ Linux = /)
 * FILE_APPEND est l'argument "flag" de la fonction file_put_contents qui permet de continuer le fichier au lieu de l'ecraser
 * file_put_contents retourne le nombre de char écrit ou false si l'ecriture est impossible
 * @ avant la fonction permet de cacher les warnings de la fonction
 * 
 */
$fichier=__DIR__.DIRECTORY_SEPARATOR ."demo.txt";
$verification_ecriture=file_put_contents($fichier,"Jeffrey remet nous des glaçons \n" , FILE_APPEND);
if ($verification_ecriture===false) {
    echo "Error : Nous avons pas réussit a écrire dans le fichier \n";
}else {
    echo "Nous avons bien écrit dans le fichier\n";
}
/**
 * Toujours avant d'utiliser la fonction dans un premier temps verifier si le fichier existe ... 
 * On peut mettre des URL dans pour récuperer le contenue du fichier MAIS pas recommandé .. 
 */

if (file_exists($fichier)) {
    $content = file_get_contents($fichier);
    echo "Le fichier contient : \n".$content;
}else {
    echo "Hélas nous avons pas réussit a lire le fichier \n";
}

$content = file_get_contents("http://philippe.cosentino.free.fr/licence/jeudelavie/");
echo $content;
 /**
  * Il existe la commande file() qui récupere les fichier ligne par ligne
  */

/**
 * Il existe aussi les même fonctions qu'en C fopen fgets fread ... pour les fichiers volumineux car PHP  ne peut pas ouvrir les gros fichier car les fonctions de base sature la mémoire
 */

?>