<?php

namespace App\Card;

class Game21
{
    protected $scoreMap = [
        '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10,
        'Jack' => 11, 'Queen' => 12, 'King' => 13, 'Ace' => 14
    ];

    protected $scoreBoard = [];

    public function __construct()
    {
        $this->scoreBoard = ['Bank' => [0], 'Player' => [0]];
    }

    public function bankDraws($deck, $bankHand)
    {
        $bankScore = $this->countScore('Bank', $bankHand);
        $bankHand->addCard($deck->drawCard());

        // if ($bankScore > 21) {
        //     $this->scoreBoard['Bank'] = 0;
        // }

        $bankScore = $this->countScore('Bank', $bankHand);
        return $bankScore;
    }

    public function score($player, $hand)
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

    public function scoreWithAce($player, $hand)
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
    
    public function countScore($player, $hand)
    {
        $values = $hand->getValues();

        if (in_array('Ace', $values)) {
            $score = $this->scoreWithAce($player, $hand);
        } else {
            $score = $this->score($player, $hand);
        }
        return $score;
    }

    public function getScoreBoard()
    {
        return $this->scoreBoard;
    }
}
