<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game21.
 */
class Game21Test extends TestCase
{
    /**
     * Construct object and verify that the object has the
     * expected properties.
     */
    public function testCreateGame21(): void
    {
        $game = new Game21();
        $this->assertInstanceOf("\App\Card\Game21", $game);
    }

    public function testBankDraws(): void
    {
        $game = new Game21();
        $deck = new DeckOfCards();

        $bankHand = new CardHand();
        $bankHand->addCard($deck->drawCard());

        $res = $game->bankDraws($deck, $bankHand);
        $this->assertIsArray($res);
    }

    /**
     * Test the winner method when the player has
     * a higher score.
     */
    public function testWinner(): void
    {
        $game = new Game21();

        // Create player's hand
        $playerHand = new CardHand();
        $playerHand->addCard(new Card("Clubs", "7"));
        $playerHand->addCard(new Card("Hearts", "Ace"));
        $game->countScore('Player', $playerHand);

        // Create bank's hand
        $bankHand = new CardHand();
        $bankHand->addCard(new Card("Diamonds", "4"));
        $bankHand->addCard(new Card("Spades", "Queen"));
        $game->countScore('Bank', $bankHand);

        // Test winner
        $result = $game->winner();
        $this->assertIsArray($result);
        $this->assertEquals('Player', $result['winner']);
        $this->assertEquals('Player has higher score.', $result['reason']);
    }

    /**
     * Test the winner method when both the player
     * and the bank have the same score.
     */
    public function testWinnerSameScore(): void
    {
        $game = new Game21();

        // Create player's hand
        $playerHand = new CardHand();
        $playerHand->addCard(new Card("Clubs", "6"));
        $playerHand->addCard(new Card("Hearts", "Jack"));
        $game->countScore('Player', $playerHand);

        // Create bank's hand
        $bankHand = new CardHand();
        $bankHand->addCard(new Card("Diamonds", "4"));
        $bankHand->addCard(new Card("Spades", "King"));
        $game->countScore('Bank', $bankHand);

        // Test winner
        $result = $game->winner();
        $this->assertEquals('Bank', $result['winner']);
        $this->assertEquals('Same score.', $result['reason']);
    }

    /**
     * Test the winner method when the player is bust.
     */
    public function testWinnerPlayerBust(): void
    {
        $game = new Game21();

        // Create player's hand
        $playerHand = new CardHand();
        $playerHand->addCard(new Card("Clubs", "9"));
        $playerHand->addCard(new Card("Hearts", "King"));
        $game->countScore('Player', $playerHand);

        // Create bank's hand
        $bankHand = new CardHand();
        $bankHand->addCard(new Card("Diamonds", "4"));
        $bankHand->addCard(new Card("Spades", "Queen"));
        $game->countScore('Bank', $bankHand);

        // Test winner
        $res = $game->winner();
        $this->assertIsArray($res);
        $this->assertEquals('Bank', $res['winner']);
        $this->assertEquals('Player is bust.', $res['reason']);

        // Add another ace to test player bust with two options
        $playerHand->addCard(new Card("Hearts", "Ace"));
        $game->countScore('Player', $playerHand);

        $res = $game->winner();
        $this->assertEquals('Bank', $res['winner']);
        $this->assertEquals('Player is bust.', $res['reason']);
    }

    /**
     * Test the winner method when the bank is bust.
     */
    public function testWinnerBankBust(): void
    {
        $game = new Game21();
        $deck = new DeckOfCards();

        // Create player's hand
        $playerHand = new CardHand();
        $playerHand->addCard(new Card("Clubs", "3"));
        $playerHand->addCard(new Card("Hearts", "King"));
        $game->countScore('Player', $playerHand);

        // Create bank's hand
        $bankHand = new CardHand();
        $bankHand->addCard(new Card("Diamonds", "10"));
        $bankHand->addCard(new Card("Spades", "Queen"));

        // Test winner
        $game->countScore('Bank', $bankHand);
        $res = $game->winner();
        $this->assertEquals('Player', $res['winner']);
        $this->assertEquals('Bank is bust.', $res['reason']);

        // Add another ace to test bank bust with two options
        $bankHand->addCard(new Card("Hearts", "Ace"));
        $game->countScore('Bank', $bankHand);

        $res = $game->winner();
        $this->assertEquals('Player', $res['winner']);
        $this->assertEquals('Bank is bust.', $res['reason']);
    }

    /**
     * Test the winner and scoring methods.
     */
    public function testWinnerFinalscores(): void
    {
        $game = new Game21();

        // Create player's hand
        $playerHand = new CardHand();
        $playerHand->addCard(new Card("Diamonds", "Ace"));
        $playerHand->addCard(new Card("Spades", "King"));
        $game->countScore('Player', $playerHand);

        // Create bank's hand
        $bankHand = new CardHand();
        $bankHand->addCard(new Card("Diamonds", "5"));
        $bankHand->addCard(new Card("Spades", "Queen"));
        $game->countScore('Bank', $bankHand);

        // Test final scores
        $res = $game->winner();
        $this->assertEquals(14, $game->getScoreBoard()['Player'][0]);
        $this->assertEquals(17, $game->getScoreBoard()['Bank'][0]);

        $this->assertEquals('Bank has higher score.', $res['reason']);
    }

    /**
     * Test the max value applied in scoring methods.
     */
    public function testBankMax(): void
    {
        $game = new Game21();

        // Create player's hand
        $playerHand = new CardHand();
        $playerHand->addCard(new Card("Diamonds", "2"));
        $playerHand->addCard(new Card("Spades", "King"));
        $game->countScore('Player', $playerHand);

        // Create bank's hand
        $bankHand = new CardHand();
        $bankHand->addCard(new Card("Diamonds", "Ace"));
        $bankHand->addCard(new Card("Spades", "5"));
        $bankHand->addCard(new Card("Hearts", "2"));
        $game->countScore('Bank', $bankHand);

        // Test final scores
        $res = $game->winner();
        $this->assertTrue($game->getScoreBoard()['Bank'][0] === 21 || $game->getScoreBoard()['Bank'][1] === 21);
        $this->assertTrue($game->getScoreBoard()['Bank'][0] === 8 || $game->getScoreBoard()['Bank'][1] === 8);

        $this->assertEquals('Bank has higher score.', $res['reason']);
    }

    /**
     * Test the min value applied in scoring methods.
     */
    public function testBankMin(): void
    {
        $game = new Game21();

        // Create player's hand
        $playerHand = new CardHand();
        $playerHand->addCard(new Card("Diamonds", "2"));
        $playerHand->addCard(new Card("Spades", "King"));
        $game->countScore('Player', $playerHand);

        // Create bank's hand
        $bankHand = new CardHand();
        $bankHand->addCard(new Card("Diamonds", "Ace"));
        $bankHand->addCard(new Card("Spades", "10"));
        $bankHand->addCard(new Card("Hearts", "10"));
        $game->countScore('Bank', $bankHand);

        // Test final scores
        $res = $game->winner();
        $this->assertTrue($game->getScoreBoard()['Bank'][0] === 21 || $game->getScoreBoard()['Bank'][1] === 21);
        $this->assertTrue($game->getScoreBoard()['Bank'][0] === 34 || $game->getScoreBoard()['Bank'][1] === 34);

        $this->assertEquals('Bank has higher score.', $res['reason']);
    }

}
