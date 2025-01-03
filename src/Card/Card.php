<?php

namespace App\Card;

class Card
{
    protected string $suit;
    protected string $value;
    protected string $graphic;

    /** @var array<string, string> */
    private static array $graphics = [
        'Spades-2' => '🂢', 'Spades-3' => '🂣', 'Spades-4' => '🂤', 'Spades-5' => '🂥',
        'Spades-6' => '🂦', 'Spades-7' => '🂧', 'Spades-8' => '🂨', 'Spades-9' => '🂩',
        'Spades-10' => '🂪', 'Spades-Jack' => '🂫', 'Spades-Queen' => '🂭', 'Spades-King' => '🂮', 'Spades-Ace' => '🂡',
        'Diamonds-2' => '🃂', 'Diamonds-3' => '🃃', 'Diamonds-4' => '🃄', 'Diamonds-5' => '🃅',
        'Diamonds-6' => '🃆', 'Diamonds-7' => '🃇', 'Diamonds-8' => '🃈', 'Diamonds-9' => '🃉',
        'Diamonds-10' => '🃊', 'Diamonds-Jack' => '🃋', 'Diamonds-Queen' => '🂽', 'Diamonds-King' => '🃎', 'Diamonds-Ace' => '🃁',
        'Hearts-2' => '🂲', 'Hearts-3' => '🂳', 'Hearts-4' => '🂴', 'Hearts-5' => '🂵',
        'Hearts-6' => '🂶', 'Hearts-7' => '🂷', 'Hearts-8' => '🂸', 'Hearts-9' => '🂹',
        'Hearts-10' => '🂺', 'Hearts-Jack' => '🂻', 'Hearts-Queen' => '🂽', 'Hearts-King' => '🂾', 'Hearts-Ace' => '🃁',
        'Clubs-2' => '🃒', 'Clubs-3' => '🃓', 'Clubs-4' => '🃔', 'Clubs-5' => '🃕',
        'Clubs-6' => '🃖', 'Clubs-7' => '🃗', 'Clubs-8' => '🃘', 'Clubs-9' => '🃙',
        'Clubs-10' => '🃚', 'Clubs-Jack' => '🃛', 'Clubs-Queen' => '🃝', 'Clubs-King' => '🃞', 'Clubs-Ace' => '🃑', 'Joker-Joker' => '🃟'
    ];

    public function __construct(string $suit, string $value)
    {
        $this->suit = $suit;
        $this->value = $value;
        $this->graphic = self::$graphics["{$suit}-{$value}"];
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getGraphic(): string
    {
        return $this->graphic;
    }

    public function __toString(): string
    {
        if ($this->suit == 'Joker') {
            return $this->suit;
        }
        return $this->value . ' of ' . $this->suit;
    }

    /** @return array<string, string> */
    public function toArray(): array
    {
        return [
            'suit' => $this->suit,
            'value' => $this->value,
            'graphic' => $this->graphic
        ];
    }
}
