<?php 
require_once 'Deck.php';
require_once 'Joueur.php';


class TablePoker {
    public array $joueurs = [];
    public array $river = [];
    public int $blind;
    public int $jetons_total_mise;
    public int $jetons_mise_round;
    public Deck $deck;

    public function __construct() {
        $this->deck = New Deck ();
    }

    public function resetTable(){
        $this->deck->resetDeck();
        foreach ($this->joueurs as $joueur) {
            $joueur -> resetJoueur();
        }
        $this->river=[];
        $this->jetons_total_mise = 0;
        $this->jetons_mise_round = 0;
    }

    public function addNewPlayer(string $name) {
        $this->joueurs[]=New Joueur($name);
    }

    public function startPhase1():bool{
        if (count($this->joueurs) > 1) {
            foreach($this->joueurs as $joueur){
                $joueur->hand = $this->deck->pickNCards(2);
            }
            $this->river = $this->deck->pickNCards(5);
            return true;
        }
        return false;
    }
}