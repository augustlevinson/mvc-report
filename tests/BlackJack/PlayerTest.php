<?php

use PHPUnit\Framework\TestCase;
use App\Card\Player;
use App\Card\Card;

class PlayerTest extends TestCase
{
    public function testPlayerCreation(): void
    {
        $player = new Player("Test", 1000);

        $this->assertEquals("Test", $player->getName());
        $this->assertEquals(1000, $player->getBalance());
    }

    public function testPlayerBet(): void
    {
        $player = new Player("Test", 1000);
        $player->setCurrentBet(500);

        $this->assertEquals(500, $player->getCurrentBet());
    }

    public function testPlayerBalanceUpdate(): void
    {
        $player = new Player("Test", 1000);
        $player->setBalance(500);

        $this->assertEquals(500, $player->getBalance());
    }

    public function testPlayerAddCard(): void
    {
        $player = new Player("Test", 1000);
        $card = new Card("Hearts", "10");
        $player->addCard($card);

        $this->assertCount(1, $player->getCards());
        $this->assertEquals(10, $player->getCardsValue()[0]);
    }

    public function testPlayerResetHand(): void
    {
        $player = new Player("Test", 1000);
        $card = new Card("Hearts", "10");
        $player->addCard($card);
        $player->resetHand();

        $this->assertCount(0, $player->getCards());
    }

    public function testGetId(): void
    {
        $player = new Player("Test");

        $this->assertIsInt($player->getId());
    }

    public function testGetSetRoundWinnings(): void
    {
        $player = new Player("Test");
        $player->setRoundWinnings(500);

        $this->assertEquals(500, $player->getRoundWinnings());
    }

    public function testGetSetCurrentScore(): void
    {
        $player = new Player("Test");
        $player->setCurrentScore([21]);

        $this->assertEquals([21], $player->getCurrentScore());
    }

    public function testGetSetPlayerStanding(): void
    {
        $player = new Player("Test");
        $player->setPlayerStanding(true);

        $this->assertTrue($player->getPlayerStanding());
    }

    public function testGetSetBlackJack(): void
    {
        $player = new Player("Test");
        $player->setBlackJack(true);

        $this->assertTrue($player->getBlackJack());
    }

    public function testGetSetBust(): void
    {
        $player = new Player("Test");
        $player->setBust(true);

        $this->assertTrue($player->getBust());
    }
}