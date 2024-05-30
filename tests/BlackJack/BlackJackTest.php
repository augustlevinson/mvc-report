<?php

use PHPUnit\Framework\TestCase;
use App\Card\BlackJack;
use App\Card\Player;
use App\Card\Card;
use App\Card\DeckOfCards;

class BlackJackTest extends TestCase
{
    /** @var BlackJack */
    private $blackJack;

    protected function setUp(): void
    {
        $this->blackJack = new BlackJack(['Player1', 'Player2', 'Player3']);
    }

    public function testConstruct(): void
    {
        $this->assertInstanceOf(BlackJack::class, $this->blackJack);
    }

    public function testGetPlayerById(): void
    {
        $playerId = $this->blackJack->getPlayers()[0]->getId();
        $player = $this->blackJack->getPlayerById($playerId);
        $nonExisting = $this->blackJack->getPlayerById(2000);

        $this->assertInstanceOf(Player::class, $player);
        $this->assertEquals($playerId, $player->getId());
        $this->assertNull($nonExisting);
    }

    public function testPlayerBlackjack(): void
    {
        $blackJack = new BlackJack(['Alice']);
        $player = $blackJack->getPlayers()[0];
        $dealer = $blackJack->getDealer();

        $player->addCard(new Card("Clubs", "Ace"));
        $player->addCard(new Card("Diamonds", "King"));
        $dealer->addCard(new Card("Hearts", "Queen"));
        $dealer->addCard(new Card("Spades", "10"));

        $blackJack->determineWinnings();

        $this->assertEquals(2.5 * $player->getCurrentBet(), $player->getRoundWinnings());
    }

    public function testPlayerAndDealerBlackjack(): void
    {
        $blackJack = new BlackJack(['Alice']);
        $player = $blackJack->getPlayers()[0];
        $dealer = $blackJack->getDealer();

        $player->addCard(new Card("Clubs", "Ace"));
        $player->addCard(new Card("Diamonds", "King"));
        $dealer->addCard(new Card("Hearts", "Queen"));
        $dealer->addCard(new Card("Spades", "Ace"));

        $blackJack->determineWinnings();

        $this->assertEquals(2.5 * $player->getCurrentBet(), $player->getRoundWinnings());
    }

    public function testPlayerBust(): void
    {
        $blackJack = new BlackJack(['Alice']);
        $player = $blackJack->getPlayers()[0];
        $dealer = $blackJack->getDealer();

        $player->addCard(new Card("Clubs", "King"));
        $player->addCard(new Card("Diamonds", "King"));
        $player->addCard(new Card("Diamonds", "8"));
        $dealer->addCard(new Card("Hearts", "Queen"));
        $dealer->addCard(new Card("Spades", "10"));

        $blackJack->determineWinnings();

        $this->assertEquals(0, $player->getRoundWinnings());
    }

    public function testPlayerWins(): void
    {
        $blackJack = new BlackJack(['Alice']);
        $player = $blackJack->getPlayers()[0];
        $dealer = $blackJack->getDealer();

        $player->addCard(new Card("Clubs", "King"));
        $player->addCard(new Card("Diamonds", "King"));
        $dealer->addCard(new Card("Hearts", "Queen"));
        $dealer->addCard(new Card("Spades", "5"));

        $blackJack->determineWinnings();

        $this->assertEquals(2 * $player->getCurrentBet(), $player->getRoundWinnings());
    }

    public function testDealerBust(): void
    {
        $blackJack = new BlackJack(['Alice']);
        $player = $blackJack->getPlayers()[0];
        $dealer = $blackJack->getDealer();

        $player->addCard(new Card("Clubs", "9"));
        $player->addCard(new Card("Diamonds", "9"));
        $dealer->addCard(new Card("Hearts", "Queen"));
        $dealer->addCard(new Card("Spades", "King"));
        $dealer->addCard(new Card("Spades", "5"));

        $blackJack->determineWinnings();

        $this->assertEquals(2 * $player->getCurrentBet(), $player->getRoundWinnings());
    }

    public function testPlayerHits(): void
    {
        $blackJack = new BlackJack(['Alice', 'Jimmy', 'Jane']);
        $player1 = $blackJack->getPlayers()[0];
        $player2 = $blackJack->getPlayers()[1];
        $player3 = $blackJack->getPlayers()[2];

        // Player2 goes bust
        $player2->addCard(new Card("Clubs", "9"));
        $player2->addCard(new Card("Clubs", "10"));
        $player2->addCard(new Card("Clubs", "5"));

        // Player3 gets blackjack
        $player3->addCard(new Card("Clubs", "Ace"));
        $player3->addCard(new Card("Spades", "King"));

        $blackJack->playerHits($player1);
        $blackJack->playerHits($player2);
        $blackJack->playerHits($player3);

        // Assert that a card was added to player's hand
        $this->assertCount(1, $player1->getCards());
        $this->assertFalse($player1->getPlayerStanding());
        
        $this->assertTrue($player2->getPlayerStanding());
    }

    public function testInitRound(): void
    {
        $blackJack = new BlackJack(['Alice']);
        $player = $blackJack->getPlayers()[0];
        $dealer = $blackJack->getDealer();

        $blackJack->initRound();

        $this->assertCount(2, $player->getCards());
        $this->assertCount(2, $dealer->getCards());
    }

    public function testNewRoundReset(): void
    {
        $blackJack = new BlackJack(['Alice']);
        $player = $blackJack->getPlayers()[0];
        $dealer = $blackJack->getDealer();

        $player->addCard(new Card("Clubs", "9"));
        $player->addCard(new Card("Diamonds", "9"));
        $dealer->addCard(new Card("Hearts", "Queen"));
        $dealer->addCard(new Card("Spades", "King"));

        $blackJack->determineWinnings();
        $blackJack->newRoundReset();

        $this->assertCount(0, $player->getCards());
        $this->assertCount(0, $dealer->getCards());
        $this->assertEquals(0, $player->getRoundWinnings());
    }

    /**
     * Test that the deck renews when fewer than 15 cards remain.
     */
    public function testRenewDeck(): void
    {
        $blackJack = new BlackJack(['Alice']);
        $player = $blackJack->getPlayers()[0];
        $dealer = $blackJack->getDealer();

        for ($i = 0; $i < 20; $i++) {
            $blackJack->dealRound();
        }

        $this->assertEquals(50, $blackJack->getDeck()->getRemainingCards());
    }

    public function testAreAllPlayersStandingTrue(): void
    {
        $blackJack = new BlackJack(['Alice', 'Bob']);
        $player1 = $blackJack->getPlayers()[0];
        $player2 = $blackJack->getPlayers()[1];

        $player1->setPlayerStanding(true);
        $player2->setPlayerStanding(true);

        $this->assertTrue($blackJack->areAllPlayersStanding());
    }

    public function testAreAllPlayersStandingFalse(): void
    {
        $blackJack = new BlackJack(['Alice', 'Bob']);
        $player1 = $blackJack->getPlayers()[0];
        $player2 = $blackJack->getPlayers()[1];

        $player1->setPlayerStanding(true);
        $player2->setPlayerStanding(false);

        $this->assertFalse($blackJack->areAllPlayersStanding());
    }

    public function testDealerPlays(): void
    {
        $blackJack = new BlackJack(['Alice']);
        $dealer = $blackJack->getDealer();

        $blackJack->dealerPlays();

        $this->assertGreaterThan(0, count($dealer->getCards()));
        $this->assertGreaterThanOrEqual(17, $dealer->getCurrentScore());
    }

    public function testRemoveBankruptPlayers(): void
    {
        $blackJack = new BlackJack(['Alice', 'Jimmy']);
        $player1 = $blackJack->getPlayers()[0];
        $player2 = $blackJack->getPlayers()[1];

        $player1->setBalance(0);

        $blackJack->removeBankruptPlayers();

        $this->assertCount(1, $blackJack->getPlayers());
    }
}
