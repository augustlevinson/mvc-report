<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateCard(): void
    {
        $card = new Card("Hearts", "10");
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->__toString();
        $this->assertNotEmpty($res);
        $this->assertEquals("10 of Hearts", $res);
    }

    /**
     * Construct object with Joker and verify that the __toString() method
     * returns the expected string.
     */
    public function testToString(): void
    {
        $card = new Card("Joker", "Joker");

        $res = $card->__toString();
        $this->assertEquals("Joker", $res);
    }

    /**
     * Construct object and verify that the getSuit() method returns the
     * expected string.
     */
    public function testGetSuit(): void
    {
        $card = new Card("Diamonds", "4");

        $res = $card->getSuit();
        $this->assertEquals("Diamonds", $res);
    }

    /**
     * Construct object and verify that the getValue() method returns the
     * expected string.
     */
    public function testGetValue(): void
    {
        $card = new Card("Spades", "Queen");

        $res = $card->getValue();
        $this->assertEquals("Queen", $res);
    }

    /**
     * Construct object and verify that the getGraphic() method returns the
     * expected string.
     */
    public function testGetGraphic(): void
    {
        $card = new Card("Clubs", "Ace");

        $res = $card->getGraphic();
        $this->assertEquals("🃑", $res);
    }

    /**
     * Construct object and verify that the toArray() method returns the
     * expected array.
     */
    public function testToArray(): void
    {
        $card = new Card("Clubs", "Ace");

        $res = $card->toArray();
        $this->assertEquals(
            [
            'suit' => "Clubs",
            'value' => "Ace",
            'graphic' => "🃑"
            ],
            $res
        );
    }
}
