<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateCardHand(): void
    {
        $hand = new CardHand();
        $this->assertInstanceOf("\App\Card\CardHand", $hand);

        // Test that the hand is empty from the start
        $res = $hand->getCards();
        $this->assertEmpty($res);

        // Test that the hand has cards after addCard()
        $this->assertEmpty($res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testAddCard(): void
    {
        $hand = new CardHand();


        // Test that the hand has cards after addCard()
        $hand->addCard(new Card("Hearts", "10"));
        $hand->addCard(new Card("Clubs", "Ace"));
        $res = $hand->getValues();
        $this->assertEquals([0 => '10', 1 => 'Ace'], $res);
    }

}
