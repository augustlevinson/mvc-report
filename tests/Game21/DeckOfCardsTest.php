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
    public function testCreateDeckOfCards()
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);
    }



    /**
     * Construct object and verify that the getAllCards() 
     * method returns an array with a length of 52.
     */
    public function testGetAllCards()
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
    public function testGetAllCardsArray()
    {
        $deck = new DeckOfCards();

        $res = $deck->getAllCardsArray();
        $this->assertEquals(
            Array(
                0 => Array (
                'suit' => 'Hearts',
                'value' => '2',
                'graphic' => '🂲',
                ),
                1 => Array (
                'suit' => 'Hearts',
                'value' => '3',
                'graphic' => '🂳',
                ),
                2 => Array (
                'suit' => 'Hearts',
                'value' => '4',
                'graphic' => '🂴',
                ),
                3 => Array (
                'suit' => 'Hearts',
                'value' => '5',
                'graphic' => '🂵',
                ),
                4 => Array (
                'suit' => 'Hearts',
                'value' => '6',
                'graphic' => '🂶',
                ),
                5 => Array (
                'suit' => 'Hearts',
                'value' => '7',
                'graphic' => '🂷',
                ),
                6 => Array (
                'suit' => 'Hearts',
                'value' => '8',
                'graphic' => '🂸',
                ),
                7 => Array (
                'suit' => 'Hearts',
                'value' => '9',
                'graphic' => '🂹',
                ),
                8 => Array (
                'suit' => 'Hearts',
                'value' => '10',
                'graphic' => '🂺',
                ),
                9 => Array (
                'suit' => 'Hearts',
                'value' => 'Jack',
                'graphic' => '🂻',
                ),
                10 => Array (
                'suit' => 'Hearts',
                'value' => 'Queen',
                'graphic' => '🂽',
                ),
                11 => Array (
                'suit' => 'Hearts',
                'value' => 'King',
                'graphic' => '🂾',
                ),
                12 => Array (
                'suit' => 'Hearts',
                'value' => 'Ace',
                'graphic' => '🃁',
                ),
                13 => Array (
                'suit' => 'Diamonds',
                'value' => '2',
                'graphic' => '🃂',
                ),
                14 => Array (
                'suit' => 'Diamonds',
                'value' => '3',
                'graphic' => '🃃',
                ),
                15 => Array (
                'suit' => 'Diamonds',
                'value' => '4',
                'graphic' => '🃄'
                ),
                16 => Array (
                'suit' => 'Diamonds',
                'value' => '5',
                'graphic' => '🃅'
                ),
                17 => Array (
                'suit' => 'Diamonds',
                'value' => '6',
                'graphic' => '🃆'
                ),
                18 => Array (
                'suit' => 'Diamonds',
                'value' => '7',
                'graphic' => '🃇'
                ),
                19 => Array (
                'suit' => 'Diamonds',
                'value' => '8',
                'graphic' => '🃈'
                ),
                20 => Array (
                'suit' => 'Diamonds',
                'value' => '9',
                'graphic' => '🃉'
                ),
                21 => Array (
                'suit' => 'Diamonds',
                'value' => '10',
                'graphic' => '🃊'
                ),
                22 => Array (
                'suit' => 'Diamonds',
                'value' => 'Jack',
                'graphic' => '🃋'
                ),
                23 => Array (
                'suit' => 'Diamonds',
                'value' => 'Queen',
                'graphic' => '🂽'
                ),
                24 => Array (
                'suit' => 'Diamonds',
                'value' => 'King',
                'graphic' => '🃎'
                ),
                25 => Array (
                'suit' => 'Diamonds',
                'value' => 'Ace',
                'graphic' => '🃁'
                ),
                26 => Array (
                'suit' => 'Clubs',
                'value' => '2',
                'graphic' => '🃒'
                ),
                27 => Array (
                'suit' => 'Clubs',
                'value' => '3',
                'graphic' => '🃓'
                ),
                28 => Array (
                'suit' => 'Clubs',
                'value' => '4',
                'graphic' => '🃔'
                ),
                29 => Array (
                'suit' => 'Clubs',
                'value' => '5',
                'graphic' => '🃕'
                ),
                30 => Array (
                'suit' => 'Clubs',
                'value' => '6',
                'graphic' => '🃖'
                ),
                31 => Array (
                'suit' => 'Clubs',
                'value' => '7',
                'graphic' => '🃗'
                ),
                32 => Array (
                'suit' => 'Clubs',
                'value' => '8',
                'graphic' => '🃘'
                ),
                33 => Array (
                'suit' => 'Clubs',
                'value' => '9',
                'graphic' => '🃙'
                ),
                34 => Array (
                'suit' => 'Clubs',
                'value' => '10',
                'graphic' => '🃚'
                ),
                35 => Array (
                'suit' => 'Clubs',
                'value' => 'Jack',
                'graphic' => '🃛'
                ),
                36 => Array (
                'suit' => 'Clubs',
                'value' => 'Queen',
                'graphic' => '🃝'
                ),
                37 => Array (
                'suit' => 'Clubs',
                'value' => 'King',
                'graphic' => '🃞'
                ),
                38 => Array (
                'suit' => 'Clubs',
                'value' => 'Ace',
                'graphic' => '🃑'
                ),
                39 => Array (
                'suit' => 'Spades',
                'value' => '2',
                'graphic' => '🂢'
                ),
                40 => Array (
                'suit' => 'Spades',
                'value' => '3',
                'graphic' => '🂣'
                ),
                41 => Array (
                'suit' => 'Spades',
                'value' => '4',
                'graphic' => '🂤'
                ),
                42 => Array (
                'suit' => 'Spades',
                'value' => '5',
                'graphic' => '🂥'
                ),
                43 => Array (
                'suit' => 'Spades',
                'value' => '6',
                'graphic' => '🂦'
                ),
                44 => Array (
                'suit' => 'Spades',
                'value' => '7',
                'graphic' => '🂧'
                ),
                45 => Array (
                'suit' => 'Spades',
                'value' => '8',
                'graphic' => '🂨'
                ),
                46 => Array (
                'suit' => 'Spades',
                'value' => '9',
                'graphic' => '🂩'
                ),
                47 => Array (
                'suit' => 'Spades',
                'value' => '10',
                'graphic' => '🂪'
                ),
                48 => Array (
                'suit' => 'Spades',
                'value' => 'Jack',
                'graphic' => '🂫'
                ),
                49 => Array (
                'suit' => 'Spades',
                'value' => 'Queen',
                'graphic' => '🂭'
                ),
                50 => Array (
                'suit' => 'Spades',
                'value' => 'King',
                'graphic' => '🂮'
                ),
                51 => Array (
                'suit' => 'Spades',
                'value' => 'Ace',
                'graphic' => '🂡'
                )
            ),
            $res
        );
    }
}