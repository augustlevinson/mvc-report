<?php

namespace App\Card;

use App\Card\Card;

class CardHand
{
    /** @var Card[]|null[] */
    protected array $cards = [];

    public function __construct()
    {
        // Constructor intentionally left empty
    }

    public function addCard(Card|null $card): void
    {
        $this->cards[] = $card;
    }

    /**
     * @return Card[]|null[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @return array<string>
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->cards as $card) {
            $values[] = $card->getValue();
        }
        return $values;
    }
}
