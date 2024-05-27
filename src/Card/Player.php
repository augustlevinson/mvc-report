<?php

namespace App\Card;

class Player
{
    /** @var <string> */
    protected $name = "";

    /** @var <int> */
    protected $balance = 0;

    /** @var <int> */
    protected $id;

    /** @var <int> */
    protected $currentBet = 0;

    /** @var <int> */
    protected $roundWinnings = 0;

    /** @var Array<int> */
    protected $currentScore = [0];

    /** @var <bool> */
    protected $isStanding = false;

    /** @var <bool> */
    protected $hasBlackJack = false;

    /** @var <bool> */
    protected $isBust = false;

    /** @var CardHand */
    protected $cardHand;

    /**
     * Constructs a new Player instance.
     */
    public function __construct($nameInput, $balanceInput=2500)
    {
        $this->name = $nameInput;
        $this->id = rand(1, 1000);
        $this->balance = $balanceInput;
        $this->cardHand = new CardHand();
    }

    /**
     * Getter function for the name of the player.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter function for the id of the player.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter function for the balance of the player.
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Setter function for the balance of the player.
     */
    public function setBalance($newBalance)
    {
        $this->balance = $newBalance;
    }

    /**
     * Getter function for the player's current bet.
     */
    public function getCurrentBet()
    {
        return $this->currentBet;
    }

    /**
     * Setter function for the player's current bet.
     */
    public function setCurrentBet($amount)
    {
        $this->currentBet = $amount;
    }

    /**
     * Getter function for the player's winnings/losses in the round.
     */
    public function getRoundWinnings()
    {
        return $this->roundWinnings;
    }

    /**
     * Setter function for the player's winnings/losses in the round.
     */
    public function setRoundWinnings($amount)
    {
        $this->roundWinnings = $amount;
    }

    /**
     * Getter function for the player's current score.
     */
    public function getCurrentScore()
    {
        return $this->currentScore;
    }

    /**
     * Setter function for the player's
     * current bet.
     */
    public function setCurrentScore($score)
    {
        $this->currentScore = $score;
    }

    /**
     * Setter function for the player's
     * standing status.
     */
    public function setPlayerStanding(bool $standing)
    {
        $this->isStanding = $standing;
    }

    /**
     * Getter function for the player's
     * standing status.
     */
    public function getPlayerStanding()
    {
        return $this->isStanding;
    }

    /**
     * Getter function for the player's
     * blackjack status.
     */
    public function getBlackJack()
    {
        return $this->hasBlackJack;
    }

    /**
     * Setter function for the player's
     * blackjack status.
     */
    public function setBlackJack(bool $blackJack)
    {
        $this->hasBlackJack = $blackJack;
        $this->isStanding = $blackJack;
    }

    /**
     * Getter function for the player's
     * bust status.
     */
    public function getBust()
    {
        return $this->isBust;
    }

    /**
     * Setter function for the player's
     * bust status.
     */
    public function setBust(bool $bust)
    {
        $this->isBust = $bust;
        $this->isStanding = $bust;
    }

    /**
     * Adds card to the player hand.
     */
    public function addCard($card)
    {
        return $this->cardHand->addCard($card);
    }

    /**
     * Getter function for the cards of the player.
     */
    public function getCards()
    {
        return $this->cardHand->getCards();
    }

    /**
     * Getter function for the values of the player's hand.
     */
    public function getCardsValue()
    {
        return $this->cardHand->getValues();
    }

    /**
     * Resets the hand to an empty one.
     */
    public function resetHand()
    {
        $this->cardHand = new CardHand();
    }
}
