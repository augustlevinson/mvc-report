<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DeckOfCards.
 */
class DeckOfCardsWithJokersTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateDeckOfCardsWithJokers(): void
    {
        $deck = new DeckOfCardsWithJokers();
        $this->assertInstanceOf(
            "\App\Card\DeckOfCardsWithJokers",
            $deck
        );
    }



    /**
     * Construct object and verify that the getAllCards()
     * method returns an array with a length of 54 (Jokers added).
     */
    public function testGetAllCards(): void
    {
        $deck = new DeckOfCardsWithJokers();

        $cards = $deck->getAllCards();

        $this->assertIsArray($cards);
        $this->assertCount(54, $cards);

        foreach ($cards as $card) {
            $this->assertInstanceOf(Card::class, $card);
        }
    }

    /**
     * Construct object and verify that the getAllCards()
     * method returns the expected array.
     */
    public function testGetAllCardsArray(): void
    {
        $deck = new DeckOfCardsWithJokers();

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
                ),
                52 => array(
                'suit' => 'Joker',
                'value' => 'Joker',
                'graphic' => '🃟'
                ),
                53 => array(
                'suit' => 'Joker',
                'value' => 'Joker',
                'graphic' => '🃟'
                ),
            ),
            $res
        );
    }
}
