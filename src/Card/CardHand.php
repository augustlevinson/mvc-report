<?php

namespace App\Card;

class CardHand
{
    protected $cards = [];

    public function __construct(int $noOfCards, $deck)
    {
        $this->cards[] = $deck.drawNumber($noOfCards);
    }
}
