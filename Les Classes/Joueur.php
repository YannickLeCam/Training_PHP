<?php
class Joueur{
    public string $name;
    public int $jetons;
    public array $hand;
    public bool $isCouche;
    public int $mise;
    public int $miseTotal;


    public function __construct( string $name , int $jetons = 2000 , bool $isCouche=false) {
        $this->name = $name;
        $this->jetons = $jetons;
        $this->isCouche = $isCouche;
    }

    public function resetJoueur():void{
        $this->mise= 0;
        $this->miseTotal = 0;
        $this->hand = [];
        $this->isCouche = false;
    }
}

?>