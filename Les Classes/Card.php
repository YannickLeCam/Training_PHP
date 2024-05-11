<?php 

class Card {
    public string $color;
    public int $value;
    public bool $isPicked;


    public function __construct(string $color, int $value , ?bool $isPicked = false) {
        $this->color = $color;
        $this->value = $value;
        $this->isPicked = $isPicked;
    }

    public function resetPicked(){
        if ($this->isPicked) {
            $this -> isPicked = false;
        }
    }

    public function pickCard(){
        $this->isPicked = true ;
    }
}