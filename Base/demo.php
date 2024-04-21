Hello world
<?php
    //Les variables

    $nom= "Le Cam";
    $prenom = "Yannick";
    $note1 = 10;
    $note2 = 15;
    echo "$nom $prenom a eu ".($note1+$note2)/2 . "/20 de moyenne\n" ;
    echo " ===================================================\n";
    //Les tableaux

    $note= [10,15,12];
    $nb_note= $note ;
    echo $note[1];

    echo "\n";

    $eleve = [
        "nom" => "Le Cam",
        "prenom" => "Yannick",
        "notes" => [8,10,15,18]
    ];

    echo $eleve["notes"][3];
    print_r($eleve);
    echo array_column($eleve["notes"],18);
    echo "\n";

    echo " ===================================================\n";
    //Les conditions

    // "(int)" Sert a convertir la sortir de readline qui est un string en int, car le "===" compare le type en plus de la valeur attention a toujours favoriser le "===" au "==" !!!!!!!!
    /*
    $note = (int)readline("Entrez votre moyenne : ");
    if ($note>10) {
        echo"Vous avez la moyenne Bravo le Veau ! \n";
    }elseif ($note === 10){
        echo "Vous avez eu tout juste la moyenne ! Piouufffff ! \n";
    } else {
        echo "Malheureusment vous n'avez pas eu la moyenne :/ \n";
    }
    */
    echo " ===================================================\n";
     // Les boucles
    $lock = 0;
    while($lock< 10)
    {
        echo $lock . "\n";
        $lock++;

    }

    echo "Bravo vous avez gagnez ! avec le chiffre = $lock \n";

    for ($i=0; $i <= 10; $i++) { 
        if ($i === 10) {
            echo "Bravo vous avez gagnez ! avec i = $i \n";
        }else{
            echo $i . "\n" ;
        }
        
    }
    $notes = [10,15,20];

    foreach ($notes as $note){
        echo "- $note \n";
    }

    $classes = [
        "6eme" => ["Laura","Joaquim","Joffrey","Nathan"],
        "5eme" => ["Marc","Joseph","Marco","Lily"]
    ];

    foreach ($classes as $classe => $eleves){

        foreach($eleves as $eleve){
            echo "$eleve est dans la classe $classe \n";
        }
    }
    /*
        EXERCICE :
        Demander a l'utilisateur ses notes le mot fin mettra fin a la prise des notes
        a la fin on affiche la liste des notes
    */  

    /*
    $input=null;
    $t_notes=[];
    $moyenne=null;
    $nb_note=null;
    while ($input!=="fin") {
        $input = readline( "Entrez votre note (Ou tapez \"fin\" pour terminer la saisie : ");
        if ($input !== "fin") {
            $t_notes[]= (int)$input;
        }
    }
    foreach($t_notes as $note){
        echo "- $note \n";
        $moyenne+=$note;
        $nb_note++;
    }
    echo " Vous avez donc " . ($moyenne/$nb_note) . "\n";
    */
    echo " ===================================================\n";
    //Les fonctions


    //EXERCICE 
    //Demander un mot au client et lui dire si le mote est un palindrome
    //strtoupper permet d'enlever les lettres en capital des mots

    /*
    $mot = strtolower(readline( "Entrez un mot pour voir si ce dernier est un palindrome : "));
    $reverse_mot = strrev($mot);

    if ($mot=== $reverse_mot) {
        echo "Ce mot est un palindrome \n";
    }else {
        echo "Ce mot n'est pas un palindrome \n";
    }
    */

    //EXERCICE 
    //A partir d'un tableau de note trouver un fonction qui permet de sommer les nb de ce tableau et connaitre la taille d'un tableau

    $notes = [rand(0,20),rand(0,20),rand(0,20)];

    echo round(array_sum($notes)/count($notes),2) . "\n";
    sort($notes);
    print_r($notes);

    //EXERCICE 
    //Filtre a insulte remplacer dans une phrase demander au client les insultes par des caractere spéciaux de la taille de l'insulte exemple : "T'es un con" serra "T'es un &@!"
    /*
    $insultes = ["merde","con"];
    $char_spec = ["#","@","$","!","?","&","%"];
    $phrase = readline("Entrez une phrase pas très gentille : ");
    
    foreach ($insultes as $insulte) {
        $rep = null;
        for ($i=0; $i < strlen($insulte); $i++) { 
            $rep= $rep . $char_spec[rand(0,6)];
        }
        $phrase = str_replace($insulte,$rep,$phrase);
    }
    echo "La phrase propre est  : \n" . $phrase . "\n";
    */



    echo "===================================================\n";
    //Fonction PARTIE 2
    //Création de fonction
    function bonjour ($nom="Yannick"){
        return "Bonjour " . $nom ." !\n";
    }
    echo bonjour("Hedi");

    function rep_oui_non($question){
        $reponse=readline($question." (o pour oui n pour non) ");
        if ($reponse==="n") {
            return false;
        }elseif ($reponse==="o") {
            return true;
        }else {
            echo "Je n'ai pas compris votre reponse \n";
            return rep_oui_non($question);
        }
    }
    //$stock=rep_oui_non("Tu vas bien ?");
    //var_dump($stock);

    //EXERCICE 
    //Faire une fonction qui prend en argument un string ou rien qui le string va etre la question poser a l'utilisateur ensuite la fonction retourne les créneaux et les affiches

    $crenneau = [];


    function demande_crenneau($question = "Veuillez entrer un crénneau : ",$crenneau=[]){
        $temp[] =readline($question);
        $temp[] =readline($question);
        if($temp[0]> $temp[1]){
            echo "Attention les données ne sont pas compatible ! Veuillez recommencer ! \n";
            return demande_crenneau($question,$crenneau);
        }else {
            $crenneau[]=$temp;
            if (rep_oui_non("Voulez vous continuer ?")) {
                return demande_crenneau($question,$crenneau);
            }else {
                return $crenneau;
            }
        }
    }

    function affiche_crenneau ( $tableau_crenneau){
        echo "Notre magasin est ouvert de ";
        sort($tableau_crenneau);
        foreach ($tableau_crenneau as $i => $crenneau) {
            if ($i > 0) {
                echo "et de ";
            }
            echo "$crenneau[0] a $crenneau[1] ";
        }
        echo "\nMerci de d'avoir consulté nos horraires \n";
    }

    $stock = demande_crenneau();
    affiche_crenneau($stock);

?>

Fin de prog...