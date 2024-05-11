<?php 
require_once 'Card.php';
class Deck {
    public array $deck;
    public int $nbPicked=0;
    public function __construct() {
        $colors = ['♥','♦','♣','♠'];
        $values = [1,2,3,4,5,6,7,8,9,10,11,12,13];
        $this->deck = [];
        foreach($colors as $color){
            foreach($values as $value){
                $this->deck[] = new Card ($color,$value);
            }
        }
        shuffle($this->deck);

    }
    /**
     * Cette fonction reset tout le deck 
     */
    public function resetDeck ():void{
        shuffle($this->deck);
        foreach($this->deck as $card){
            $card->resetPicked();
        }
        $this->nbPicked = 0;
    }

    /**
     * Prends un int correspondant au nombre de cartes que vous voulez pick
     * Si il n'y a pas assez de carte pour etre pris alors renvoie un tableau vide /!\
     * Sinon renvoit un tableau de cartes vouluent piocher aléatoirement dans le deck en faisant attention que la carte ne soit pas deja pick
     */
    public function pickNCards(int $countCard):array{
        $retour = [];
        if (((count($this->deck)-$this->nbPicked)-$countCard)<0) {
            return [];
        }
        else {
            for ($i=0; $i < $countCard ; $i++) { 
                $card_select = $this->deck[rand(0,count($this->deck)-1)];
                if ($card_select->isPicked) {
                    $i--;
                }else {
                    $card_select->pickCard();
                    $retour[]=$card_select;
                    $this->nbPicked++;
                }
            }
            return $retour;
        }

    }
}


?>