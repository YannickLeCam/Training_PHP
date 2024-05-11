<?php
require_once ('Deck.php');
/**
 * EXERCICE D'ENTRAINEMENT SUR LES CLASSES DE PHP
 * Le but de cette section est de créer un deck de carte a jouer classique allant de AS a Roi contenant les 4 couleurs 
 * Ensuite une fois fait le deck, nous allons devoir faire une methode pouvant mélanger les cartes et reset si elles été pick (grace aux methodes card intégré).
 */

$deck = New Deck();
$deck->shuffleDeck();
$hand = $deck->pickNCards(2);
$hand2 = $deck -> pickNCards(2);

var_dump($hand,$hand2);


?>