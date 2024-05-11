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

function isSuit(array $cards):bool {
    $verification=[];
    foreach ($cards as $card) {
        $verification[] = $card->value;
    }
    sort($verification);
    //il faut gerer le cas AS = 14 ou 1 
    return true;
}

$cardmerge=[];
for ($i=0; $i < 7; $i++) { 
    $cardmerge[]=New Card ("♦",1+$i);
}
shuffle($cardmerge);
isSuit($cardmerge);
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
var_dump(isFlush($cardmerge));

function isQuinteFlushRoyal(array $card){

}

class ClassementPoker {
    public array $Gagnant;

    public function __construct(array $joueurs) {
        $this->var = $var;
    }
}