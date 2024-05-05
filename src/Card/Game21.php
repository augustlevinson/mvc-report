<?php

namespace App\Card;

class Game21
{
    /** @var array<string|int,int> */
    protected $scoreMap = [
        '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10,
        'Jack' => 11, 'Queen' => 12, 'King' => 13, 'Ace' => 14
    ];

    /** @var array<string,array<int>> */
    protected $scoreBoard = [];

    /**
     * Constructs a new Game21 instance.
     */
    public function __construct()
    {
        $this->scoreBoard = ['Bank' => [0], 'Player' => [0]];
    }

    /**
     * Draws a card for the bank and updates the score.
     *
     * @return array<int> The updated score of the bank.
     */
    public function bankDraws(DeckOfCards $deck, CardHand $bankHand): array
    {
        $bankScore = $this->countScore('Bank', $bankHand);
        $bankScore = $this->countScore('Bank', $bankHand);
        $card = $deck->drawCard();
        if ($card !== null) {
            $bankHand->addCard($card);
        }

        $bankScore = $this->countScore('Bank', $bankHand);
        return $bankScore;
    }

    /**
     * Calculates and updates the score for a player.
     *
     * @return array<int> The updated score of the player.
     */
    public function score(string $player, CardHand $hand): array
    {
        $values = $hand->getValues();
        $score = 0;

        foreach ($values as $value) {
            $score += $this->scoreMap[$value];
        }

        $scoreArray = [$score];
        $this->scoreBoard[$player] = $scoreArray;
        return $scoreArray;
    }

    /**
     * Calculates and updates the score for a player, considering the Ace card as 1 or 14.
     *
     * @return array<int> The updated score of the player.
     */
    public function scoreWithAce(string $player, CardHand $hand): array
    {
        $values = $hand->getValues();
        $score1 = 0;
        $score2 = 0;

        foreach ($values as $value) {
            if ($value == 'Ace') {
                $score1 += 1;
                $score2 += 14;
            } else {
                $score1 += $this->scoreMap[$value];
                $score2 += $this->scoreMap[$value];
            }
        }
        $scoreArray = [$score1, $score2];
        $this->scoreBoard[$player] = $scoreArray;
        return $scoreArray;
    }

    /**
     * Counts the score for a player, considering the presence of an Ace card.
     *
     * @return array<int> The calculated score of the player.
     */
    public function countScore(string $player, CardHand $hand): array
    {
        $values = $hand->getValues();

        if (in_array('Ace', $values)) {
            $score = $this->scoreWithAce($player, $hand);
        } else {
            $score = $this->score($player, $hand);
        }
        return $score;
    }

    /**
     * Returns the current score board.
     *
     * @return array<string,array<int>> The current score board.
     */
    public function getScoreBoard(): array
    {
        return $this->scoreBoard;
    }

    /**
     * Determines the winner of the game and the reason for winning.
     *
     * @return array<string,string> The winner and the reason for winning.
     */
    public function winner(): array
    {
        $playerScore = $this->scoreBoard['Player'];
        $bankScore = $this->scoreBoard['Bank'];


        if (count($playerScore) == 2) {
            if ($playerScore[0] > 21 && $playerScore[1] > 21) {
                $winner = 'Bank';
                $reason = 'Player is bust.';
                return ['winner' => $winner, 'reason' => $reason];
            } else {
                if ($playerScore[0] == 21 || $playerScore[1] == 21) {
                    $playerFinal = 21;
                } elseif ($playerScore[0] > 21 || $playerScore[1] > 21) {
                    $playerFinal = min($playerScore);
                } else {
                    $playerFinal = max($playerScore);
                }
            }
        } else {
            if ($playerScore[0] > 21) {
                $winner = 'Bank';
                $reason = 'Player is bust.';
                return ['winner' => $winner, 'reason' => $reason];
            } else {
                $playerFinal = $playerScore[0];
            }
        }

        if (count($bankScore) == 2) {
            if ($bankScore[0] > 21 && $bankScore[1] > 21) {
                $winner = 'Player';
                $reason = 'Bank is bust.';
                return ['winner' => $winner, 'reason' => $reason];
            } else {
                if ($bankScore[0] > 21 || $bankScore[1] > 21) {
                    $bankFinal = min($bankScore);
                } else {
                    $bankFinal = max($bankScore);
                }
            }
        } else {
            if ($bankScore[0] > 21) {
                $winner = 'Player';
                $reason = 'Bank is bust.';
                return ['winner' => $winner, 'reason' => $reason];
            } else {
                $bankFinal = $bankScore[0];
            }
        }

        if ($playerFinal <= 21 && $playerFinal > $bankFinal) {
            $winner = 'Player';
            $reason = 'Player has higher score.';
        } elseif ($playerFinal < $bankFinal) {
            $winner = 'Bank';
            $reason = 'Bank has higher score.';
        } else {
            $winner = 'Bank';
            $reason = 'Same score.';
        }
        return ['winner' => $winner, 'reason' => $reason];
    }
}
