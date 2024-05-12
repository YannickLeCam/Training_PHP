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
        var_dump($value);
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
                echo "Je reset compteur \n";
            }
        }
    }
    var_dump($verification , $compteur);
    return false;
}
function testSuit(){
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

    // test couleur fausse
    $cardmerge = [];
    $cardmerge[]=New Card ("♥",2);
    $cardmerge[]=New Card ("♦",1);
    $cardmerge[]=New Card ("♥",13);
    $cardmerge[]=New Card ("♦",2);
    $cardmerge[]=New Card ("♦",4);
    $cardmerge[]=New Card ("♦",5);
    $cardmerge[]=New Card ("♦",3);
    echo "Est sensé retrouver false : \n";
    var_dump(isQuinteFlush($cardmerge));

function isQuinteFlushRoyal(array $card){

}

class ClassementPoker {
    public array $Gagnant;

    public function __construct(array $joueurs) {
        $this->var = $var;
    }
}