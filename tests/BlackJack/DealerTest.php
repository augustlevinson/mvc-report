<?php

use PHPUnit\Framework\TestCase;
use App\Card\Dealer;
use App\Card\Card;

class DealerTest extends TestCase
{
    public function testDealerCreation(): void
    {
        $dealer = new Dealer();

        $this->assertInstanceOf("\App\Card\Dealer", $dealer);
        $this->assertEquals("Dealer", $dealer->getName());
    }

    public function testDealerSetGetBalance(): void
    {
        $dealer = new Dealer();
        $this->assertEquals(null, $dealer->setBalance(1000));
        $this->assertEquals(null, $dealer->getBalance());
    }
}