<?php

namespace App\Card;

class DeckOfCards
{
    protected $cards = [];

    public function __construct()
    {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace'];

        foreach ($suits as $suit) {
            foreach ($values as $index => $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }
    }

    public function getAllCards()
    {
        return $this->cards;
    }

    public function shuffleCards()
    {
        shuffle($this->cards);
    }

    public function drawCard()
    {
        if (count($this->cards) == 0) {
            return null;
        } else {
            $drawnCardIndex = array_rand($this->cards);
            if (array_key_exists($drawnCardIndex, $this->cards)) {
                $drawnCard = $this->cards[$drawnCardIndex];
                array_splice($this->cards, $drawnCardIndex, 1);
                return $drawnCard;
            } else {
                return null;
            }
        }
    }

    public function drawNumber(int $number)
    {
        if (count($this->cards) == 0) {
            return null;
        }
        $drawnCards = [];
        if (count($this->cards) < $number) {
            $iterate = count($this->cards);
        } else {
            $iterate = $number;
        }

        for ($i = 0; $i < $iterate; $i++) {
            $drawnCardIndex = array_rand($this->cards);
            if (array_key_exists($drawnCardIndex, $this->cards)) {
                $drawnCards[] = $this->cards[$drawnCardIndex];
                array_splice($this->cards, $drawnCardIndex, 1);
            }
        }

        return $drawnCards;
    }

    public function getRemainingCards()
    {
        return count($this->cards);
    }
}
