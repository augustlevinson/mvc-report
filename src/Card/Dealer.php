<?php

namespace App\Card;

class Dealer extends Player
{
    /**
     * Constructs a new Dealer instance.
     */
    public function __construct()
    {
        $this->cardHand = new CardHand();
    }

    /**
     * Override the getName method to return "Dealer".
     */
    public function getName(): string
    {
        return "Dealer";
    }

    /**
     * Override the getBalance method to return null.
     */
    public function getBalance(): int
    {
        return null;
    }

    /**
     * Override the setBalance method to do nothing.
     */
    public function setBalance($newBalance): void
    {
        // Do nothing
    }
}