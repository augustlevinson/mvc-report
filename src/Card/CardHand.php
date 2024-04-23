<?php

namespace App\Card;

class CardHand
{
    protected $cards = [];

    public function __construct()
    {
        
    }

    public function addCard(Card $card)
    {
        $this->cards[] = $card;
    }

    public function getCards()
    {
        return $this->cards;
    }

    public function getValues()
    {
        $values = [];
        foreach ($this->cards as $card) {
            $values[] = $card->getValue();
        }
        return $values;
    }
}
