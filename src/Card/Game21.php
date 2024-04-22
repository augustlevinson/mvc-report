<?php

namespace App\Card;

class Game21
{
    protected $scoreMap = [
        '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10,
        'Jack' => 11, 'Queen' => 12, 'King' => 13, 'Ace' => 14
    ];

    protected $scoreBoard = [];

    public function __construct(int $noOfCards)
    {
        $this->cards[] = DeckOfCards::drawNumber($noOfCards);
    }
}
