<?php

namespace App\Card;

class DeckOfCardsWithJokers extends DeckOfCards
{
    public function __construct()
    {
        parent::__construct();

        for ($i = 0; $i < 2; $i++) {
            $this->cards[] = new Card('Joker', 'Joker');
        }
    }
}
