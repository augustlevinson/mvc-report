<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game21.
 */
class Game21Test extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateGame21()
    {
        $game = new Game21();
        $this->assertInstanceOf("\App\Card\Game21", $game);
    }
}