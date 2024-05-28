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
    /** @var array<string,array<int>> */
protected $scoreBoard = [];

    /**
     * Constructs a new BlackJack instance.
     * @param array<string> $playersArray The array of player names.
     */
    public function __construct($playersArray)
    {
        foreach ($playersArray as $player) {

            $this->players[] = new Player($player);
            $this->deck = new DeckOfCards();
        }

        $this->dealer = new Dealer();

    }

    /**
     * Get a player by their id.
     * @param int $id The id of the player.
     */
    public function getPlayerById($id): ?Player
    {
        foreach ($this->players as $player) {
            if ($player->getId() == $id) {
                return $player;
            }
        }
        return null;
    }

    public function newRoundReset(): void
    {
        foreach ($this->players as $player) {
            $player->resetHand();
            $player->setCurrentBet(0);
            $player->setRoundWinnings(0);
            $player->setPlayerStanding(false);
            $this->unsetBust($player);
            $this->unsetBlackJack($player);
        }

        $this->removeBankruptPlayers();

        $this->dealer->resetHand();
    }

    /**
     * Initializes a new round of the game and deals two cards each.
     */
    public function initRound(): void
    {
        if ($this->deck->getRemainingCards() < 15) {
            $this->deck = new DeckOfCards();
        }

        for ($i = 0; $i < 2; $i++) {
            foreach ($this->players as $player) {
                $player->addCard($this->deck->drawCard());
            }

            $this->dealer->addCard($this->deck->drawCard());
        }
    }

    /**
     * Places bets and deals one card each.
     */
    public function dealRound(): void
    {
        if ($this->deck->getRemainingCards() < 15) {
            $this->deck = new DeckOfCards();
        }

        foreach ($this->players as $player) {
            $player->addCard($this->deck->drawCard());
        }

        $this->dealer->addCard($this->deck->drawCard());
    }

    /**
     * Getter function for the player array.
     * @return array<Player> The array of player names.
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * Getter function for the player array.
     * @return Dealer The dealer object.
     */
    public function getDealer(): Dealer
    {
        return $this->dealer;
    }

    /**
     * Checks if a hand is bust (score > 21).
     * @param Player $player The player to check.
     * @return bool True if the player is bust, false otherwise.
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
     * @param Player $player The player to mark as bust.
     */
    public function setBust(Player $player): void
    {
        $player->setBust(true);
    }

    /**
     * Marks a player as not bust.
     * @param Player $player The player to mark as not bust.
     */
    public function unsetBust(Player $player): void
    {
        $player->setBust(false);
    }

    /**
     * Checks if player hand is blackjack (score == 21).
     * @param Player $player The player to check.
     * @return bool True if the player has blackjack, false otherwise.
     */
    public function isBlackJack(Player $player)
    {
        $isBlackJack = in_array(21, $this->calculatePlayerScore($player));

        return $isBlackJack;
    }

    /**
     * Marks a player as having blackjack.
     * @param Player $player The player to mark as having blackjack.
     */
    public function setBlackJack(Player $player): void
    {
        $player->setBlackJack(true);
    }

    /**
     * Marks a player as not having blackjack.
     * @param Player $player The player to mark as not having blackjack.
     */
    public function unsetBlackJack(Player $player): void
    {
        $player->setBlackJack(false);
    }

    /**
     * Draws a card for the dealer.
     */
    public function dealerDrawsCard(): void
    {
        // TODO: Implement dealerDrawsCard() method.
    }

    /**
     * Marks a specific player's hand as standing (no more cards will be drawn).
     * @param Player $player The player to mark as standing.
     */
    public function playerStands(Player $player): void
    {
        $player->setPlayerStanding(true);
    }

    /**
     * Draws a card for the player and marks them as standing if bust or blackjack.
     * @param Player $player The player that hits.
     */
    public function playerHits(Player $player): void
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
     * @return bool True if all players are standing, false otherwise.
     */
    public function areAllPlayersStanding(): bool
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
    public function dealerPlays(): void
    {
        $scoreArray = $this->calculatePlayerScore($this->dealer);

        while (!in_array(21, $scoreArray) && max($scoreArray) < 17 && min($scoreArray) < 17) {
            $this->dealer->addCard($this->deck->drawCard());
            $scoreArray = $this->calculatePlayerScore($this->dealer);
        }
    }

    /**
     * Remove players who have run out of money.
     */
    public function removeBankruptPlayers(): void
    {
        foreach ($this->players as $key => $player) {
            if ($player->getBalance() <= 0) {
                unset($this->players[$key]);
            }
        }
    }

    /**
     * Determines what players, if any, get a pay-out and how much.
     */
    public function determineWinnings(): void
    {
        foreach ($this->players as $player) {
            $playerScore = $player->getCurrentScore();
            $dealerScore = $this->dealer->getCurrentScore();

            if (!$this->isBust($player)) {
                // Case: Player has blackjack
                if ($this->isBlackJack($player)) {
                    if ($this->isBlackJack($this->dealer)) {
                        // Player gets back their bet
                        $player->setBalance($player->getBalance() + $player->getCurrentBet());
                        $player->setRoundWinnings($player->getCurrentBet());
                    } else {
                        // Player gets back 2.5 times the bet
                        $player->setBalance($player->getBalance() + $player->getCurrentBet() * 2.5);
                        $player->setRoundWinnings($player->getCurrentBet() * 2.5);
                    }
                } else {
                    if (max($playerScore) > 21) {
                        $playerScoreUsed = min($playerScore);
                    } else {
                        $playerScoreUsed = max($playerScore);
                    }
                    if (max($dealerScore) > 21) {
                        $dealerScoreUsed = min($dealerScore);
                    } else {
                        $dealerScoreUsed = max($dealerScore);
                    }

                    if ($this->isBust($this->dealer)) {
                        // Player gets back 2 times the bet
                        $player->setBalance($player->getBalance() + $player->getCurrentBet() * 2);
                        $player->setRoundWinnings($player->getCurrentBet() * 2);
                    } else {
                        // Case: Player has a higher score than the dealer
                        if ($playerScoreUsed > $dealerScoreUsed) {
                            // Player gets back 2 times the bet
                            $player->setBalance($player->getBalance() + $player->getCurrentBet() * 2);
                            $player->setRoundWinnings($player->getCurrentBet() * 2);
                        } elseif ($playerScoreUsed == $dealerScoreUsed) {
                            // Player gets back their bet
                            $player->setBalance($player->getBalance() + $player->getCurrentBet());
                            $player->setRoundWinnings($player->getCurrentBet());
                        }
                    }
                }
            }
            $player->setRoundWinnings($player->getRoundWinnings() - $player->getCurrentBet());
        }
    }

    /**
     * Calculates and the score for a player.
     * 
     * @param array<string> $values The values of the cards in the player's hand.
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
     * @param array<string> $values The values of the cards in the player's hand.
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
     * @return array<int> The updated score of the player.
     */
    public function calculatePlayerScore(Player $player): array
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
