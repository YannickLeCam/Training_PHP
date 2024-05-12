<?php 
require_once('./Card.php');


function isFlush(array $cards):bool{
    $verification=[
        "♥" => 0,
        "♦" => 0,
        "♣" => 0,
        "♠" => 0
    ];
    foreach($cards as $card){
        foreach ($verification as $couleur => $compte) {
            
            if ($card->color == $couleur) {
                $verification[$couleur]=$compte+1;
                //pourquoi compte++; ne fonctionne pas ???
            }
        }
    }
    var_dump($verification);
    foreach ($verification as $key => $value) {
        if ($value > 4) {
            return true;
        }
    }
    return false;
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

function isSuit(array $cards):bool {
    $verification=[];
    foreach ($cards as $card) {
        $verification[] = $card->value;
        if ($card->value==1) {
            $verification[]=14;
        }
    }
    sort($verification);
    //il faut gerer le cas AS = 14 ou 1
    $lastvalue = $verification[0];
    $compteur = 1;

    foreach ($verification as $i => $value) {
        if ($value == $lastvalue+1) {
            $lastvalue = $value;
            $compteur++;
            if ($compteur > 4) {
                return true;
            }
        }else {
            if ($lastvalue == $value) {
                continue;
            }else {
                $compteur = 1;
                $lastvalue = $value;
            }
        }
    }
    return false;
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

function isQuinteFlush(array $cards):bool{
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
            if(isSuit($sortedCards)){
                return true;
            }
        }
    }
    return false;
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
    
    foreach ($trie as $couleur => $sortedCards) {
        if (count($sortedCards)>4) {
            if(isSuit($sortedCards)){
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
                        }
                    }
                }
                if ($compteur[1]>0 & $compteur[13]>0 & $compteur[12]>0 & $compteur[11]>0 & $compteur[10]>0) {
                    return true;
                }
            }
        }
    }
    return false;
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
        if (isset($verification[$card->value])) {
            $verification[$card->value]=$verification[$card->value]+1;
        }else {
            $verification[$card->value]=1;
        }
    }
    foreach ($verification as $value => $compte) {
        if ($compte==2) {
            return true;
        }
    }
    return false;
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
    $cardmerge[]=New Card ("♦",4);
    $cardmerge[]=New Card ("♥",3);
    $cardmerge[]=New Card ("♣",9);
    $cardmerge[]=New Card ("♠",9);
    $cardmerge[]=New Card ("♦",8);
    $cardmerge[]=New Card ("♦",9);
    echo "Est sensé retrouver false : \n";
    var_dump(isPair($cardmerge));
}

//testPair();

function isBrelan(array $cards):bool {
    $verification = [];
    foreach ($cards as $card) {
        if (isset($verification[$card->value])) {
            $verification[$card->value]=$verification[$card->value]+1;
        }else {
            $verification[$card->value]=1;
        }
    }
    foreach ($verification as $value => $compte) {
        if ($compte==3) {
            return true;
        }
    }
    return false;
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



function isCarre(array $cards):bool {
    $verification = [];
    foreach ($cards as $card) {
        if (isset($verification[$card->value])) {
            $verification[$card->value]=$verification[$card->value]+1;
        }else {
            $verification[$card->value]=1;
        }
    }
    foreach ($verification as $value => $compte) {
        if ($compte==4) {
            return true;
        }
    }
    return false;
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
    echo "Est sensé retrouver false : \n";
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
    echo "Est sensé retrouver false : \n";
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
    echo "Est sensé retrouver false : \n";
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
    echo "Est sensé retrouver false : \n";
    var_dump(isCarre($cardmerge));
}

//testCarre();

function isDoublePair(array $cards){
    $verification = [];
    foreach ($cards as $card) {
        if (isset($verification[$card->value])) {
            $verification[$card->value]=$verification[$card->value]+1;
        }else {
            $verification[$card->value]=1;
        }
    }
    $nbPaires=0;
    foreach ($verification as $value => $compte) {
        if ($compte==2) {
            $nbPaires++;
        }
    }
    if ($nbPaires>1) {
        return true;
    }
    return false;
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
    echo "Est sensé retrouver false : \n";
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

function isFullHouse(array $cards){
    if (isPair($cards) & isBrelan($cards)) {
        return true;
    }else {
        return false;
    }
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

class ClassementPoker {
    public array $Gagnant;

    public function __construct(array $joueurs) {
        $this->var = $var;
    }
}