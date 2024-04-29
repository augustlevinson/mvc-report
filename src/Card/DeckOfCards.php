<?php

namespace App\Card;

class DeckOfCards
{
    /** @var Card[] */
    protected array $cards = [];

    public function __construct()
    {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace'];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }
    }

    /**
     * @return Card[]
     */
    public function getAllCards(): array
    {
        return $this->cards;
    }

    /**
     * @return array<array<string, string>>
     */
    public function getAllCardsArray(): array
    {
        $cards = [];
        foreach ($this->cards as $card) {
            $cards[] = $card->toArray();
        }
        return $cards;
    }

    public function shuffleCards(): void
    {
        shuffle($this->cards);
    }

    /**
     * @return Card|null
     */
    public function drawCard(): ?Card
    {
        if (count($this->cards) === 0) {
            return null;
        }

        $drawnCardIndex = array_rand($this->cards);
        $drawnCard = $this->cards[$drawnCardIndex];
        array_splice($this->cards, (int)$drawnCardIndex, 1);

        return $drawnCard;
    }

    /**
     * @param int $number
     * @return Card[]|null
     */
    public function drawNumber(int $number): ?array
    {
        if (count($this->cards) === 0) {
            return null;
        }

        $drawnCards = [];
        $iterate = min(count($this->cards), $number);

        for ($i = 0; $i < $iterate; $i++) {
            $drawnCardIndex = array_rand($this->cards);
            $drawnCards[] = $this->cards[$drawnCardIndex];
            array_splice($this->cards, (int)$drawnCardIndex, 1);
        }

        return $drawnCards;
    }

    /**
     * @return int
     */
    public function getRemainingCards(): int
    {
        return count($this->cards);
    }
}
