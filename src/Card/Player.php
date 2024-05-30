<?php

namespace App\Card;

class Player
{
    /** @var string */
    protected $name = "";

    /** @var int|float */
    protected $balance = 0;

    /** @var int */
    protected $id;

    /** @var int|float */
    protected $currentBet = 0;

    /** @var int|float */
    protected $roundWinnings = 0;

    /** @var Array<int|string> */
    protected $currentScore = [0];

    /** @var bool */
    protected $isStanding = false;

    /** @var bool */
    protected $hasBlackJack = false;

    /** @var bool */
    protected $isBust = false;

    /** @var CardHand */
    protected $cardHand;

    /**
     * Constructs a new Player instance.
     * @param string $nameInput
     * @param int $balanceInput
     */
    public function __construct($nameInput, $balanceInput = 2500)
    {
        $this->name = $nameInput;
        $this->id = rand(1, 1000);
        $this->balance = $balanceInput;
        $this->cardHand = new CardHand();
    }

    /**
     * Getter function for the name of the player.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Getter function for the id of the player.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter function for the balance of the player.
     */
    public function getBalance(): int|float
    {
        return $this->balance;
    }

    /**
     * Setter function for the balance of the player.
     * @param int|float $newBalance
     */
    public function setBalance($newBalance): void
    {
        $this->balance = $newBalance;
    }

    /**
     * Getter function for the player's current bet.
     */
    public function getCurrentBet(): int|float
    {
        return $this->currentBet;
    }

    /**
     * Setter function for the player's current bet.
     * @param int|float $amount
     */
    public function setCurrentBet($amount): void
    {
        $this->currentBet = $amount;
    }

    /**
     * Getter function for the player's winnings/losses in the round.
     */
    public function getRoundWinnings(): int|float
    {
        return $this->roundWinnings;
    }

    /**
     * Setter function for the player's winnings/losses in the round.
     * @param int|float $amount
     */
    public function setRoundWinnings($amount): void
    {
        $this->roundWinnings = $amount;
    }

    /**
     * Getter function for the player's current score.
     * @return array<int|string>
     */
    public function getCurrentScore(): array
    {
        return $this->currentScore;
    }

    /**
     * Setter function for the player's
     * current score.
     * @param array<int|string> $score
     */
    public function setCurrentScore($score): void
    {
        $this->currentScore = $score;
    }

    /**
     * Setter function for the player's
     * standing status.
     * @param bool $standing
     */
    public function setPlayerStanding(bool $standing): void
    {
        $this->isStanding = $standing;
    }

    /**
     * Getter function for the player's
     * standing status.
     */
    public function getPlayerStanding(): bool
    {
        return $this->isStanding;
    }

    /**
     * Getter function for the player's
     * blackjack status.
     */
    public function getBlackJack(): bool
    {
        return $this->hasBlackJack;
    }

    /**
     * Setter function for the player's
     * blackjack status.
     * @param bool $blackJack
     */
    public function setBlackJack(bool $blackJack): void
    {
        $this->hasBlackJack = $blackJack;
        $this->isStanding = $blackJack;
    }

    /**
     * Getter function for the player's
     * bust status.
     */
    public function getBust(): bool
    {
        return $this->isBust;
    }

    /**
     * Setter function for the player's
     * bust status.
     */
    public function setBust(bool $bust): void
    {
        $this->isBust = $bust;
        $this->isStanding = $bust;
    }

    /**
     * Adds card to the player hand.
     * @param Card|null $card
     */
    public function addCard($card): bool|null
    {
        return $this->cardHand->addCard($card);
    }

    /**
     * Getter function for the cards of the player.
     * @return array<Card|null>
     */
    public function getCards(): array
    {
        return $this->cardHand->getCards();
    }

    /**
     * Getter function for the values of the player's hand.
     * @return array<int|string>
     */
    public function getCardsValue(): array
    {
        return $this->cardHand->getValues();
    }

    /**
     * Resets the hand to an empty one.
     */
    public function resetHand(): void
    {
        $this->cardHand = new CardHand();
    }
}
