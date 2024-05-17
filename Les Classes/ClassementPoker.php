<?php 
require_once('./Card.php');


function isFlush(array $cards):array{
    $verification=[
        "♥" => [],
        "♦" => [],
        "♣" => [],
        "♠" => []
    ];
    foreach($cards as $card){
        foreach ($verification as $couleur => $compte) {
            
            if ($card->color == $couleur) {
                $verification[$couleur][]=$card;
                //pourquoi compte++; ne fonctionne pas ???
            }
        }
    }
    foreach ($verification as $key => $value) {
        if (count($value) > 4) {
            return $value;
        }
    }
    return [];
}
function testFlush(){
    echo "===========================================\n";
    echo "Debut des Testes pour la Flush\n";
    echo "===========================================\n";
    $cardmerge=[];
    for ($i=0; $i < 7; $i++) { 
        $cardmerge[]=New Card ("♦",1+$i);
    }
    echo "Est sensé retrouver true : \n";
    var_dump(isFlush($cardmerge));
    // test couleur fausse
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",13);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",9);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isFlush($cardmerge));
}
//testFlush();

function isSuit(array $cards):array {
    $values = [];
    $hasAce = false;

    // Créer un tableau des valeurs des cartes, en tenant compte de la possibilité de l'As en tant que 1 ou 14
    foreach ($cards as $card) {
        $values[$card->value][] = $card;
        if ($card->value == 1) {
            $values[14][] = $card; // Ajouter également l'As en tant que 14
        }
    }

    // Initialiser les variables pour la recherche de suite
    $sequence = [];
    $longestSequence = [];

    // Parcourir les valeurs des cartes dans l'ordre décroissant pour trouver la plus longue suite
    for ($i = 14; $i >= 1; $i--) {
        if (isset($values[$i])) {
            $sequence[] = $values[$i][0]; // Ajouter la première carte de chaque valeur à la suite
            if (count($sequence) == 5) {
                // Mise à jour de la suite la plus longue
                $longestSequence = $sequence;
            }
        } else {
            // La suite est brisée, réinitialiser la séquence
            $sequence = [];
        }
    }

    // Vérifier si la plus longue suite a une longueur d'au moins 5 pour être considérée comme une suite
    if (count($longestSequence) >= 5) {
        return $longestSequence;
    } else {
        return []; // Aucune suite de 5 cartes ou plus trouvée
    }
}


function testSuit(){
    echo "===========================================\n";
    echo "Debut des Testes pour la Suite\n";
    echo "===========================================\n";
    //Suite avec l'AS == 1
    $cardmerge=[];
    for ($i=0; $i < 7; $i++) { 
        $cardmerge[]=New Card ("♦",1+$i);
    }
    echo "Est sensé retrouver true : \n";
    var_dump(isSuit($cardmerge));
    // test couleur fausse
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",13);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",9);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isSuit($cardmerge));
    //Une suite avec l'as = 14
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",13);
    $cardmerge[]=New Card ("♥",12);
    $cardmerge[]=New Card ("♣",11);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver true : \n";
    var_dump(isSuit($cardmerge));
    //avec une paire au milieu de la suite cela fonctionne
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♥",6);
    $cardmerge[]=New Card ("♣",7);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver true : \n";
    var_dump(isSuit($cardmerge));
}
//testSuit();

//A modifier
function isQuinteFlush(array $cards):array{
    $trie =[
        "♥" => [],
        "♦" => [],
        "♠" => [],
        "♣" => []
    ];

    foreach ($cards as  $card) {
        foreach ($trie as $couleur => $TabCard) {
            if ($card->color == $couleur) {
                $trie[$couleur][] = $card;
            }
        }
    }
    
    foreach ($trie as $couleur => $sortedCards) {
        if (count($sortedCards)>4) {
            $temp = isSuit($sortedCards);
            if($temp!=[]){
                return $temp;
            }
        }
    }
    return [];
}

function testQuinteFlush(){
    echo "=========================================== \n";
    echo "Debut des Testes pour la Quinte Flush \n";
    echo "=========================================== \n";
    //Suite avec l'AS == 1
    $cardmerge=[];
    for ($i=0; $i < 7; $i++) { 
        $cardmerge[]=New Card ("♦",1+$i);
    }
    echo "Est sensé retrouver true : \n";
    var_dump(isQuinteFlush($cardmerge));
    // test couleur fausse
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",13);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",9);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isQuinteFlush($cardmerge));
    //Une suite avec l'as = 14
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",13);
    $cardmerge[]=New Card ("♥",12);
    $cardmerge[]=New Card ("♣",11);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isQuinteFlush($cardmerge));
    //avec une paire au milieu de la suite cela fonctionne
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♥",6);
    $cardmerge[]=New Card ("♣",7);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver false : \n";
    var_dump(isQuinteFlush($cardmerge));
    $cardmerge = [];
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♦",10);
    $cardmerge[]=New Card ("♣",7);
    $cardmerge[]=New Card ("♦",11);
    $cardmerge[]=New Card ("♦",12);
    $cardmerge[]=New Card ("♦",13);
    echo "Est sensé retrouver true : \n";
    var_dump(isQuinteFlush($cardmerge));
    //test d'une suite suite sans couleur
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",4);
    $cardmerge[]=New Card ("♥",3);
    $cardmerge[]=New Card ("♣",2);
    $cardmerge[]=New Card ("♠",5);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver false : \n";
    var_dump(isQuinteFlush($cardmerge));
}

//testQuinteFlush();

function isQuinteFlushRoyal(array $cards){
    $trie =[
        "♥" => [],
        "♦" => [],
        "♠" => [],
        "♣" => []
    ];

    foreach ($cards as  $card) {
        foreach ($trie as $couleur => $TabCard) {
            if ($card->color == $couleur) {
                $trie[$couleur][] = $card;
            }
        }
    }
    $retour = [];
    foreach ($trie as $couleur => $sortedCards) {
        if (count($sortedCards)>4) {
            if(isSuit($sortedCards)!=[]){
                $compteur=[
                    1=>0,
                    13=>0,
                    12=>0,
                    11=>0,
                    10=>0
                ];
                foreach ($sortedCards as $card) {
                    foreach ($compteur as $valeur => $compte) {
                        if ($card->value == $valeur) {
                            $compteur[$valeur]=$compte+1;
                            $retour[0][]=$card;
                        }
                    }
                }
                if ($compteur[1]>0 & $compteur[13]>0 & $compteur[12]>0 & $compteur[11]>0 & $compteur[10]>0) {
                    return $retour;
                }
            }
        }
    }
    return [];
}

function testQuinteFlushRoyal(){
    echo "=========================================== \n";
    echo "Debut des Testes pour la Quinte Flush Royal \n";
    echo "=========================================== \n";
    //Suite avec l'AS == 1
    $cardmerge=[];
    for ($i=0; $i < 7; $i++) { 
        $cardmerge[]=New Card ("♦",1+$i);
    }
    echo "Est sensé retrouver false : \n";
    var_dump(isQuinteFlushRoyal($cardmerge));
    // test couleur fausse
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",13);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",9);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isQuinteFlushRoyal($cardmerge));
    //Une suite avec l'as = 14
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",13);
    $cardmerge[]=New Card ("♥",12);
    $cardmerge[]=New Card ("♣",11);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isQuinteFlushRoyal($cardmerge));
    //avec une paire au milieu de la suite cela fonctionne
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♥",6);
    $cardmerge[]=New Card ("♣",7);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver false : \n";
    var_dump(isQuinteFlushRoyal($cardmerge));
    $cardmerge = [];
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♦",10);
    $cardmerge[]=New Card ("♣",7);
    $cardmerge[]=New Card ("♦",11);
    $cardmerge[]=New Card ("♦",12);
    $cardmerge[]=New Card ("♦",13);
    echo "Est sensé retrouver true : \n";
    var_dump(isQuinteFlushRoyal($cardmerge));
    //test d'une suite suite sans couleur
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",4);
    $cardmerge[]=New Card ("♥",3);
    $cardmerge[]=New Card ("♣",2);
    $cardmerge[]=New Card ("♠",5);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver false : \n";
    var_dump(isQuinteFlushRoyal($cardmerge));
}


//testQuinteFlushRoyal();

function isPair( array $cards){
    $verification = [];
    foreach ($cards as $card) {
        if ($card->value == 1) {
            $verification[14][]=$card;
        }
        $verification[$card->value][]=$card;
    }
    $Paire=[];
    //on part de la plus forte valeur pour récupérer les valeur les plus hautes
    for ($i=14; $i > 1 ; $i--) { 
        if (isset($verification[$i])) {
            if (count($verification[$i])==2) {
                $Paire[]=$verification[$i];
            }
            if (count($Paire)==1) {
                return $Paire;
            }
        }
    }
    return [];
}
function testPair(){
    echo "=========================================== \n";
    echo "Debut des Testes pour la Paire \n";
    echo "=========================================== \n";
    //Suite avec l'AS == 1
    $cardmerge=[];
    for ($i=0; $i < 7; $i++) { 
        $cardmerge[]=New Card ("♦",1+$i);
    }
    echo "Est sensé retrouver false : \n";
    var_dump(isPair($cardmerge));
    // test couleur fausse
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",13);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",9);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver true : \n";
    var_dump(isPair($cardmerge));
    //Une suite avec l'as = 14
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",13);
    $cardmerge[]=New Card ("♥",12);
    $cardmerge[]=New Card ("♣",11);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver true : \n";
    var_dump(isPair($cardmerge));
    $cardmerge = [];
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♦",10);
    $cardmerge[]=New Card ("♣",7);
    $cardmerge[]=New Card ("♦",11);
    $cardmerge[]=New Card ("♦",12);
    $cardmerge[]=New Card ("♦",13);
    echo "Est sensé retrouver false : \n";
    var_dump(isPair($cardmerge));
    //test de paire avec un brelan
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",3);
    $cardmerge[]=New Card ("♣",9);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver true : \n";
    var_dump(isPair($cardmerge));
}

//testPair();

function isBrelan(array $cards):array {
    $verification = [];
    foreach ($cards as $card) {
        if ($card->value == 1) {
            $verification[14][]=$card;
        }
        $verification[$card->value][]=$card;
    }
    $Brelan=[];
    //on part de la plus forte valeur pour récupérer les valeur les plus hautes
    for ($i=14; $i > 1 ; $i--) { 
        if (isset($verification[$i])) {
            if (count($verification[$i])==3) {
                $Brelan[]=$verification[$i];
            }
            if (count($Brelan)==1) {
                return $Brelan;
            }
        }
    }
    return [];
}


function testBrelan(){
    echo "=========================================== \n";
    echo "Debut des Testes pour le Brelan \n";
    echo "=========================================== \n";
    //Suite avec l'AS == 1
    $cardmerge=[];
    for ($i=0; $i < 7; $i++) { 
        $cardmerge[]=New Card ("♦",1+$i);
    }
    echo "Est sensé retrouver false : \n";
    var_dump(isBrelan($cardmerge));
    // test couleur fausse
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",13);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",9);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isBrelan($cardmerge));
    //Une suite avec l'as = 14
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",13);
    $cardmerge[]=New Card ("♥",12);
    $cardmerge[]=New Card ("♣",11);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isBrelan($cardmerge));
    //test avec un carré
    $cardmerge = [];
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♦",10);
    $cardmerge[]=New Card ("♣",7);
    $cardmerge[]=New Card ("♥",10);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isBrelan($cardmerge));
    //test de paire avec un brelan
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",4);
    $cardmerge[]=New Card ("♥",3);
    $cardmerge[]=New Card ("♣",9);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver true : \n";
    var_dump(isBrelan($cardmerge));
}

//testBrelan();



function isCarre(array $cards):array {
    $verification = [];
    foreach ($cards as $card) {
        if ($card->value == 1) {
            $verification[14][]=$card;
        }
        $verification[$card->value][]=$card;
    }
    $Carre=[];
    //on part de la plus forte valeur pour récupérer les valeur les plus hautes
    for ($i=14; $i > 1 ; $i--) { 
        if (isset($verification[$i])) {
            if (count($verification[$i])==4) {
                $Carre[]=$verification[$i];
            }
            if (count($Carre)==1) {
                return $Carre;
            }
        }
    }
    return [];

}

function testCarre(){
    echo "=========================================== \n";
    echo "Debut des Testes pour le Carre \n";
    echo "=========================================== \n";
    //Suite avec l'AS == 1
    $cardmerge=[];
    for ($i=0; $i < 7; $i++) { 
        $cardmerge[]=New Card ("♦",1+$i);
    }
    echo "Est sensé retrouver [] : \n";
    var_dump(isCarre($cardmerge));
    // test couleur fausse
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",13);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",9);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver [] : \n";
    var_dump(isCarre($cardmerge));
    //Une suite avec l'as = 14
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",13);
    $cardmerge[]=New Card ("♥",12);
    $cardmerge[]=New Card ("♣",11);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver [] : \n";
    var_dump(isCarre($cardmerge));
    //test avec un carré
    $cardmerge = [];
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♦",10);
    $cardmerge[]=New Card ("♣",7);
    $cardmerge[]=New Card ("♥",10);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",10);
    echo "Est sensé retrouver true : \n";
    var_dump(isCarre($cardmerge));
    //test de Carre avec un brelan
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",4);
    $cardmerge[]=New Card ("♥",3);
    $cardmerge[]=New Card ("♣",9);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver [] : \n";
    var_dump(isCarre($cardmerge));
}

//testCarre();

function isDoublePair(array $cards):array{
    $verification = [];
    foreach ($cards as $card) {
        if ($card->value == 1) {
            $verification[14][]=$card;
        }
        $verification[$card->value][]=$card;
    }
    $doublePair=[];
    for ($i=14; $i > 1 ; $i--) { 
        if (isset($verification[$i])) {
            if (count($verification[$i])==2) {
                $doublePair[]=$verification[$i];
            }
            if (count($doublePair)==2) {
                return $doublePair;
            }
        }
    }

    return [];
}

function testDoublePair(){
    echo "=========================================== \n";
    echo "Debut des Testes pour le DoublePair \n";
    echo "=========================================== \n";
    //Suite avec l'AS == 1
    $cardmerge=[];
    for ($i=0; $i < 7; $i++) { 
        $cardmerge[]=New Card ("♦",1+$i);
    }
    echo "Est sensé retrouver false : \n";
    var_dump(isDoublePair($cardmerge));
    // test couleur fausse
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",13);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",9);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver true : \n";
    var_dump(isDoublePair($cardmerge));
    //Une suite avec l'as = 14
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",13);
    $cardmerge[]=New Card ("♥",12);
    $cardmerge[]=New Card ("♣",11);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isDoublePair($cardmerge));
    //test avec un double paire
    $cardmerge = [];
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♦",2);
    $cardmerge[]=New Card ("♣",7);
    $cardmerge[]=New Card ("♥",7);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",10);
    echo "Est sensé retrouver true : \n";
    var_dump(isDoublePair($cardmerge));
    //test de double paires avec un brelan et une paire
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♥",3);
    $cardmerge[]=New Card ("♣",9);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver false : \n";
    var_dump(isDoublePair($cardmerge));
}
//testDoublePair();

function isFullHouse(array $cards):array{

    $Pair = isPair($cards);
    $Brelan= isBrelan($cards);
    if ($Pair != [] & $Brelan != []) {
        return array_merge($Pair[0],$Brelan[0]);
    }
    return [];
}

function testFullHouse(){
    echo "=========================================== \n";
    echo "Debut des Testes pour le FullHouse \n";
    echo "=========================================== \n";
    //Suite avec l'AS == 1
    $cardmerge=[];
    for ($i=0; $i < 7; $i++) { 
        $cardmerge[]=New Card ("♦",1+$i);
    }
    echo "Est sensé retrouver false : \n";
    var_dump(isFullHouse($cardmerge));
    // test couleur fausse
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",13);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",9);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isFullHouse($cardmerge));
    //Une suite avec l'as = 14
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",13);
    $cardmerge[]=New Card ("♥",12);
    $cardmerge[]=New Card ("♣",11);
    $cardmerge[]=New Card ("♠",8);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isFullHouse($cardmerge));
    //test avec un double paire
    $cardmerge = [];
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♦",2);
    $cardmerge[]=New Card ("♣",7);
    $cardmerge[]=New Card ("♥",7);
    $cardmerge[]=New Card ("♣",10);
    $cardmerge[]=New Card ("♠",10);
    echo "Est sensé retrouver false : \n";
    var_dump(isFullHouse($cardmerge));
    //test de double paires avec un brelan et une paire
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♥",3);
    $cardmerge[]=New Card ("♣",9);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver true : \n";
    var_dump(isFullHouse($cardmerge));
}

//testFullHouse();

function isHighCard(array $cards):array{
    $retour = $cards[0];
    foreach ($cards as $card) {
        //detect AS qui est la plus haute carte possible
        if ($card->value == 1) {
            return [$card];
        }
        if ($card->value > $retour->value) {
            $retour = $card;
        }
    }
    return [$retour];
}

function testHighCard(){
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",1);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♥",3);
    $cardmerge[]=New Card ("♣",9);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver 1 ♥ : \n";
    var_dump(isHighCard($cardmerge));

    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♥",3);
    $cardmerge[]=New Card ("♣",9);
    $cardmerge[]=New Card ("♠",13);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver 13 ♠ : \n";
    var_dump(isHighCard($cardmerge));
}

//testHighCard();

class ClassementPoker {
    public array $Gagnant;
    public array $TAB_HANDS = [
        "0" => [],//Quinte Flush Royal
        "1" => [],//Quinte FLush
        "2" => [],//Carre
        "3" => [],//Full
        "4" => [],//Couleur
        "5" => [],//Suite
        "6" => [],//Brelan
        "7" => [],//Double Paire
        "8" => [],//Paire
        "9" => [],//Carte haute
    ];
    public function __construct(array $joueurs,array $riviere) {
        foreach ($joueurs as $joueur) {
            $Cardsmerge = array_merge($joueur->hand , $riviere);
            //var_dump($joueur,$Cardsmerge);
            if (($temp = isQuinteFlushRoyal($Cardsmerge)) != []) {
                echo "Je suis dans QuinteFR\n";
                $this->TAB_HANDS["0"][] = [$joueur,$temp];
            }elseif (($temp = isQuinteFlush($Cardsmerge)) != []) {
                echo "Je suis dans QuinteF\n";
                $this->TAB_HANDS["1"][] = [$joueur,$temp];
            }elseif (($temp = isCarre($Cardsmerge)) != []) {
                echo "Je suis dans Carre\n";
                $this->TAB_HANDS["2"][] = [$joueur,$temp];
            }elseif (($temp = isFullHouse($Cardsmerge)) != []) {
                echo "Je suis dans Full\n";
                $this->TAB_HANDS["3"][] = [$joueur,$temp];  
            }elseif (($temp = isFlush($Cardsmerge)) != []) {
                echo "Je suis dans Flush\n";
                $this->TAB_HANDS["4"][] = [$joueur,$temp];
            }elseif (($temp = isSuit($Cardsmerge)) != []) {
                echo "Je suis dans Suite\n";
                $this->TAB_HANDS["5"][] = [$joueur,$temp];
            }elseif (($temp = isBrelan($Cardsmerge)) != []) {
                echo "Je suis dans Brelan\n";
                $this->TAB_HANDS["6"][] = [$joueur,$temp];
            }elseif (($temp = isDoublePair($Cardsmerge)) != []) {
                echo "Je suis dans DP\n";
                $this->TAB_HANDS["7"][] = [$joueur,$temp];
            }elseif (($temp = isPair($Cardsmerge)) != []) {
                echo "Je suis dans Pair\n";
                $this->TAB_HANDS["8"][] = [$joueur,$temp];
            }elseif (($temp = isHighCard($Cardsmerge)) != []) {
                echo "Je suis dans HC\n";
                $this->TAB_HANDS["9"][] = [$joueur,$temp];
            }
        }
        for ($i= 9;$i>=0;$i--) { 
            if (count($this->TAB_HANDS["$i"])>0) {
                if (count($this->TAB_HANDS["$i"])==1) {
                    $this->Gagnant = $this->TAB_HANDS["$i"];
                    break;
                }
                else {
                    //faire en sorte de voir si il y a une égalité
                    $this->Gagnant = $this->TAB_HANDS["$i"];
                }
            }
        }

    }
}