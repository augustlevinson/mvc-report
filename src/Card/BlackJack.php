<?php

namespace App\Card;

class BlackJack
{
    /** @var int */
    protected int $numberOfPlayers;

    /** @var array<string|int,int> */
    protected $scoreMap = [
        '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10,
        'Jack' => 10, 'Queen' => 10, 'King' => 10, 'Ace' => 11
    ];

    /** @var array<string,array<int>> */
    protected $scoreBoard = [];

    /**
     * Constructs a new BlackJack instance.
     */
    public function __construct($numOfPlayers)
    {
        $this->numberOfPlayers = $numOfPlayers;
        // create a Player object for each player, and populate it with an empty CardHand object and bank account
        // create an empty CardHand for the house
    }

    /**
     * Places a bet on a specific hand.
     */
    public function placeBet(int $handIndex, int $amount)
    {
        // TODO: Implement placeBet() method.
        // Take an array of bets as input and store it in the Player object
    }

    /**
     * Deals the initial cards to all players and the house.
     */
    public function dealInitialCards()
    {
        // TODO: Implement dealInitialCards() method.
    }

    /**
     * Calculates the score of a given hand, 
     * considering the special rule for Ace (can be 1 or 11).
     */
    public function calculateScore(CardHand $hand)
    {
        // TODO: Implement calculateScore() method.
    }

    /**
     * Checks if a hand is bust (score > 21).
     */
    public function isBust(CardHand $hand)
    {
        // TODO: Implement isBust() method.
    }

    /**
     * Checks if a hand is blackjack.
     */
    public function isBlackjack(CardHand $hand)
    {
        // TODO: Implement isBlackjack() method.
    }

    /**
     * Checks if a hand is a push (same score as the house).
     */
    public function playerDrawsCard(int $handIndex)
    {
        // TODO: Implement playerDrawsCard() method.
    }

    /**
     * Draws a card for the bank.
     */
    public function bankDrawsCard()
    {
        // TODO: Implement bankDrawsCard() method.
    }

    /**
     * Marks a specific player's hand as standing (no more cards will be drawn).
     */
    public function playerStands(int $handIndex)
    {
        // TODO: Implement playerStands() method.
    }

    /**
     * Checks if all players are standing.
     */
    public function areAllPlayersStanding()
    {
        // TODO: Implement areAllPlayersStanding() method.
    }

    /**
     * Plays the bank's turn (draws cards until score is 17 or higher).
     */
    public function bankPlays()
    {
        // TODO: Implement bankPlays() method.
    }

    /**
     * Determines the winner of the game based on the 
     * scores of the player's hands and the bank's hand.
     */
    public function determineWinner()
    {
        // TODO: Implement determineWinner() method.
    }

    /**
     * Returns the bet placed on a specific hand.
     */
    public function getHandBet(int $handIndex)
    {
        // TODO: Implement getHandBet() method.
    }

    /**
     * Returns the score of a specific hand.
     */
    public function getHandScore(int $handIndex)
    {
        // TODO: Implement getHandScore() method.
    }

    /**
     * Returns the score of the bank's hand.
     */
    public function getBankScore()
    {
        // TODO: Implement getBankScore() method.
    }
}
