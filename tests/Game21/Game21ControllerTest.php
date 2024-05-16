<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Game21ControllerTest extends WebTestCase
{
    // ...

    public function testGameInit()
    {
        $client = static::createClient();

        $client->request('GET', '/game/init');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h3', 'Player: 0'); // Replace 'h1' and 'Game Init' with actual values from template
    }
}