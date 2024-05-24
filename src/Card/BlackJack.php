<?php

namespace App\Card;

class BlackJack
{
    /** @var array<string> */
    protected $players;

    /** @var DeckOfCards */
    protected $deck;

    /** @var Dealer */
    protected $dealer;

    /** @var array<string|int,int> */
    protected $scoreMap = [
        '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10,
        'Jack' => 10, 'Queen' => 10, 'King' => 10, 'Ace' => 11
    ];

    /** @var array<Player> */
    protected $standingPlayers = [];

    /** @var array<string,array<int>> */
    protected $scoreBoard = [];

    /**
     * Constructs a new BlackJack instance.
     */
    public function __construct($playersArray)
    {
        foreach ($playersArray as $player) {

            $this->players[] = new Player($player);
            $this->deck = new DeckOfCards;
        }

        $this->dealer = new Dealer;

    }

    /**
     * Initializes a new round of the game and deals two cards each.
     */
    public function initRound()
    {
        if ($this->deck->getRemainingCards() < 15) {
            $this->deck = new DeckOfCards;
        }

        for ($i=0; $i<2; $i++) {
            foreach ($this->players as $player) {
                $player->addCard($this->deck->drawCard());
            }

            $this->dealer->addCard($this->deck->drawCard());
        }
    }

    /**
     * Places bets and deals one card each.
     */
    public function dealRound()
    {
        if ($this->deck->getRemainingCards() < 15) {
            $this->deck = new DeckOfCards;
        }

        foreach ($this->players as $player) {
            $player->addCard($this->deck->drawCard());
        }

        $this->dealer->addCard($this->deck->drawCard());
    }

    /**
     * Getter function for the player array.
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Getter function for the player array.
     */
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * Checks if a hand is bust (score > 21).
     */
    public function isBust(Player $player)
    {
        $scores = $this->calculatePlayerScore($player);

        foreach ($scores as $score) {
            if ($score <= 21) {
                return false;
            }
        }
    
        $this->setBust($player);
        return true;
    }

    /**
     * Marks a player as bust.
     */
    public function setBust(Player $player)
    {
        $player->setBust(true);
    }

    /**
     * Marks a player as not bust.
     */
    public function unsetBust(Player $player)
    {
        $player->setBust(false);
    }

    /**
     * Checks if player hand is blackjack (score == 21).
     */
    public function isBlackJack(Player $player)
    {
        $isBlackJack = in_array(21, $this->calculatePlayerScore($player));

        return $isBlackJack;
    }

    /**
     * Marks a player as having blackjack.
     */
    public function setBlackJack(Player $player)
    {
        $player->setBlackJack(true);
    }

    /**
     * Marks a player as not having blackjack.
     */
    public function unsetBlackJack(Player $player)
    {
        $player->setBlackJack(false);
    }

    /**
     * Draws a card for the dealer.
     */
    public function dealerDrawsCard()
    {
        // TODO: Implement dealerDrawsCard() method.
    }

    /**
     * Marks a specific player's hand as standing (no more cards will be drawn).
     */
    public function playerStands(Player $player)
    {
        $player->setPlayerStanding(true);
    }

    /**
     * Draws a card for the player and marks them as standing if bust or blackjack.
     */
    public function playerHits(Player $player)
    {
        $player->addCard($this->deck->drawCard());

        if ($this->isBlackJack($player)) {
            $this->setBlackJack($player);
            $this->playerStands($player);
        } elseif ($this->isBust($player)) {
            $this->setBust($player);
            $this->playerStands($player);
        }
    }

    /**
     * Checks if all players are standing.
     */
    public function areAllPlayersStanding()
    {
        foreach ($this->players as $player) {
            if (!$player->getPlayerStanding()) {
                return false;
            }
        }
        return true;
    }

    /**
     * Plays the dealer's turn (draws cards until score is 17 or higher).
     */
    public function dealerPlays()
    {
        $scoreArray = $this->calculatePlayerScore($this->dealer);

        while (!in_array(21, $scoreArray) && max($scoreArray) < 17) {
            $this->dealer->addCard($this->deck->drawCard());
            $scoreArray = $this->calculatePlayerScore($this->dealer);
        }
    }

    /**
     * Determines the winner of the game based on the 
     * scores of the player's hands and the dealer's hand.
     */
    public function determineWinner()
    {
        // TODO: Implement determineWinner() method.
    }

    /**
     * Calculates and the score for a player.
     * @return array<int> The updated score of the player.
     */
    public function score(array $values): array
    {
        $score = 0;

        foreach ($values as $value) {
            $score += $this->scoreMap[$value];
        }

        return [$score];
    }

    /**
     * Calculates and the score for a player, considering the Ace card as 1 or 11.
     *
     * @return array<int> The updated score of the player.
     */
    public function scoreWithAce(array $values): array
    {
        $score1 = 0;
        $score2 = 0;

        foreach ($values as $value) {
            if ($value == 'Ace') {
                $score1 += 1;
                $score2 += 11;
            } else {
                $score1 += $this->scoreMap[$value];
                $score2 += $this->scoreMap[$value];
            }
        }
        $scoreArray = [$score1, $score2];
        return $scoreArray;
    }

    /**
     * Sets and returns an array of potential scores of a player's hand.
     */
    public function calculatePlayerScore(Player $player)
    {
        $values = $player->getCardsValue();

        $score = 0;

        if (in_array('Ace', $values)) {
            $score = $this->scoreWithAce($values);
            $scoreArray = $score;
        } else {
            $score = $this->score($values);
            $scoreArray = $score;
        }

        $player->setCurrentScore($scoreArray);

        return $scoreArray;
    }
}
