<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DeckOfCards.
 */
class DeckOfCardsTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateDeckOfCards(): void
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);
    }



    /**
     * Construct object and verify that the getAllCards()
     * method returns an array with a length of 52.
     */
    public function testGetAllCards(): void
    {
        $deck = new DeckOfCards();

        $cards = $deck->getAllCards();

        $this->assertIsArray($cards);
        $this->assertCount(52, $cards);

        foreach ($cards as $card) {
            $this->assertInstanceOf(Card::class, $card);
        }
    }

    /**
     * Construct object and verify that the getAllCards() method returns the
     * expected array.
     */
    public function testGetAllCardsArray(): void
    {
        $deck = new DeckOfCards();

        $res = $deck->getAllCardsArray();
        $this->assertEquals(
            array(
                0 => array(
                'suit' => 'Hearts',
                'value' => '2',
                'graphic' => '🂲',
                ),
                1 => array(
                'suit' => 'Hearts',
                'value' => '3',
                'graphic' => '🂳',
                ),
                2 => array(
                'suit' => 'Hearts',
                'value' => '4',
                'graphic' => '🂴',
                ),
                3 => array(
                'suit' => 'Hearts',
                'value' => '5',
                'graphic' => '🂵',
                ),
                4 => array(
                'suit' => 'Hearts',
                'value' => '6',
                'graphic' => '🂶',
                ),
                5 => array(
                'suit' => 'Hearts',
                'value' => '7',
                'graphic' => '🂷',
                ),
                6 => array(
                'suit' => 'Hearts',
                'value' => '8',
                'graphic' => '🂸',
                ),
                7 => array(
                'suit' => 'Hearts',
                'value' => '9',
                'graphic' => '🂹',
                ),
                8 => array(
                'suit' => 'Hearts',
                'value' => '10',
                'graphic' => '🂺',
                ),
                9 => array(
                'suit' => 'Hearts',
                'value' => 'Jack',
                'graphic' => '🂻',
                ),
                10 => array(
                'suit' => 'Hearts',
                'value' => 'Queen',
                'graphic' => '🂽',
                ),
                11 => array(
                'suit' => 'Hearts',
                'value' => 'King',
                'graphic' => '🂾',
                ),
                12 => array(
                'suit' => 'Hearts',
                'value' => 'Ace',
                'graphic' => '🃁',
                ),
                13 => array(
                'suit' => 'Diamonds',
                'value' => '2',
                'graphic' => '🃂',
                ),
                14 => array(
                'suit' => 'Diamonds',
                'value' => '3',
                'graphic' => '🃃',
                ),
                15 => array(
                'suit' => 'Diamonds',
                'value' => '4',
                'graphic' => '🃄'
                ),
                16 => array(
                'suit' => 'Diamonds',
                'value' => '5',
                'graphic' => '🃅'
                ),
                17 => array(
                'suit' => 'Diamonds',
                'value' => '6',
                'graphic' => '🃆'
                ),
                18 => array(
                'suit' => 'Diamonds',
                'value' => '7',
                'graphic' => '🃇'
                ),
                19 => array(
                'suit' => 'Diamonds',
                'value' => '8',
                'graphic' => '🃈'
                ),
                20 => array(
                'suit' => 'Diamonds',
                'value' => '9',
                'graphic' => '🃉'
                ),
                21 => array(
                'suit' => 'Diamonds',
                'value' => '10',
                'graphic' => '🃊'
                ),
                22 => array(
                'suit' => 'Diamonds',
                'value' => 'Jack',
                'graphic' => '🃋'
                ),
                23 => array(
                'suit' => 'Diamonds',
                'value' => 'Queen',
                'graphic' => '🂽'
                ),
                24 => array(
                'suit' => 'Diamonds',
                'value' => 'King',
                'graphic' => '🃎'
                ),
                25 => array(
                'suit' => 'Diamonds',
                'value' => 'Ace',
                'graphic' => '🃁'
                ),
                26 => array(
                'suit' => 'Clubs',
                'value' => '2',
                'graphic' => '🃒'
                ),
                27 => array(
                'suit' => 'Clubs',
                'value' => '3',
                'graphic' => '🃓'
                ),
                28 => array(
                'suit' => 'Clubs',
                'value' => '4',
                'graphic' => '🃔'
                ),
                29 => array(
                'suit' => 'Clubs',
                'value' => '5',
                'graphic' => '🃕'
                ),
                30 => array(
                'suit' => 'Clubs',
                'value' => '6',
                'graphic' => '🃖'
                ),
                31 => array(
                'suit' => 'Clubs',
                'value' => '7',
                'graphic' => '🃗'
                ),
                32 => array(
                'suit' => 'Clubs',
                'value' => '8',
                'graphic' => '🃘'
                ),
                33 => array(
                'suit' => 'Clubs',
                'value' => '9',
                'graphic' => '🃙'
                ),
                34 => array(
                'suit' => 'Clubs',
                'value' => '10',
                'graphic' => '🃚'
                ),
                35 => array(
                'suit' => 'Clubs',
                'value' => 'Jack',
                'graphic' => '🃛'
                ),
                36 => array(
                'suit' => 'Clubs',
                'value' => 'Queen',
                'graphic' => '🃝'
                ),
                37 => array(
                'suit' => 'Clubs',
                'value' => 'King',
                'graphic' => '🃞'
                ),
                38 => array(
                'suit' => 'Clubs',
                'value' => 'Ace',
                'graphic' => '🃑'
                ),
                39 => array(
                'suit' => 'Spades',
                'value' => '2',
                'graphic' => '🂢'
                ),
                40 => array(
                'suit' => 'Spades',
                'value' => '3',
                'graphic' => '🂣'
                ),
                41 => array(
                'suit' => 'Spades',
                'value' => '4',
                'graphic' => '🂤'
                ),
                42 => array(
                'suit' => 'Spades',
                'value' => '5',
                'graphic' => '🂥'
                ),
                43 => array(
                'suit' => 'Spades',
                'value' => '6',
                'graphic' => '🂦'
                ),
                44 => array(
                'suit' => 'Spades',
                'value' => '7',
                'graphic' => '🂧'
                ),
                45 => array(
                'suit' => 'Spades',
                'value' => '8',
                'graphic' => '🂨'
                ),
                46 => array(
                'suit' => 'Spades',
                'value' => '9',
                'graphic' => '🂩'
                ),
                47 => array(
                'suit' => 'Spades',
                'value' => '10',
                'graphic' => '🂪'
                ),
                48 => array(
                'suit' => 'Spades',
                'value' => 'Jack',
                'graphic' => '🂫'
                ),
                49 => array(
                'suit' => 'Spades',
                'value' => 'Queen',
                'graphic' => '🂭'
                ),
                50 => array(
                'suit' => 'Spades',
                'value' => 'King',
                'graphic' => '🂮'
                ),
                51 => array(
                'suit' => 'Spades',
                'value' => 'Ace',
                'graphic' => '🂡'
                )
            ),
            $res
        );
    }

    /**
     * Construct object and verify that the shuffleDeck() method shuffles the deck.
     */
    public function testShuffleCards(): void
    {
        $deck = new DeckOfCards();

        $cardsBeforeShuffle = $deck->getAllCardsArray();
        $deck->shuffleCards();
        $cardsAfterShuffle = $deck->getAllCardsArray();

        // Assert that the number of cards is the same before and after shuffle
        $this->assertCount(count($cardsBeforeShuffle), $cardsAfterShuffle);

        // Assert that the cards are the same before and after shuffle
        sort($cardsBeforeShuffle);
        sort($cardsAfterShuffle);
        $this->assertEquals($cardsBeforeShuffle, $cardsAfterShuffle);

        // Assert that the order of cards has changed
        $this->assertNotEquals($deck->getAllCardsArray(), $cardsBeforeShuffle);
    }

    /**
     * Construct object and verify that the drawCard()
     * method returns a Card object and decrements the
     * number of cards in the deck by 1.
     */
    public function testDrawCard(): void
    {
        $deck = new DeckOfCards();
        $drawnCard = $deck->drawCard();

        // Deck is decreased by 1
        $this->assertCount(51, $deck->getAllCards());

        // Drawn card is a Card object
        $this->assertInstanceOf(Card::class, $drawnCard);

        // When deck is empty, the method returns null
        $deck->drawNumber(51);
        $drawnCard = $deck->drawCard();
        $this->assertNull($drawnCard);
    }

    /**
     * Construct object and verify that the drawNumber()
     * method returns a Card object and decrements the
     * number of cards in the deck by the number in argument (6).
     */
    public function testDrawNumber(): void
    {
        $deck = new DeckOfCards();
        $drawnCards = $deck->drawNumber(6);

        // The returned value is an array
        $this->assertIsArray($drawnCards);

        // The number of drawn cards is 6
        $this->assertCount(6, $drawnCards);

        // The deck is decreased by 6
        $this->assertCount(46, $deck->getAllCards());

        // When deck is empty, the method returns null
        $deck->drawNumber(46);
        $drawnCards = $deck->drawNumber(1);
        $this->assertNull($drawnCards);
    }

    /**
     * Construct object and verify that the drawNumber()
     * method returns a Card object and decrements the
     * number of cards in the deck by the number in argument (6).
     */
    public function testGetRemainingCards(): void
    {
        $deck = new DeckOfCards();

        // The returned value is an integer
        $this->assertIsInt($deck->getRemainingCards());
        // The number of remaining cards is 38
        $this->assertEquals(52, $deck->getRemainingCards());

        $deck->drawNumber(14);
        // The number of remaining cards is 38
        $this->assertEquals(38, $deck->getRemainingCards());

        $deck->drawNumber(12);
        // The number of remaining cards is 34
        $this->assertEquals(26, $deck->getRemainingCards());
    }
}
