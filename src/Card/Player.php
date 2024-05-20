<?php

namespace App\Card;

class Player
{
    /** @var <int> */
    protected $name = "";
    /** @var <int> */
    protected $balance = 0;

    /**
     * Constructs a new Player instance.
     */
    public function __construct($nameInput)
    {
        $this->$name = $nameInput;
        $this->$balance = 2500;
    }

    /**
     * Getter function for the name of the player.
     */
    public function getName()
    {
        return $this->$name;
    }

    /**
     * Getter function for the balance of the player.
     */
    public function getBalance()
    {
        return $this->$balance;
    }

    /**
     * Setter function for the balance of the player.
     */
    public function setBalance($newBalance)
    {
        $this->$balance = $newBalance;
    }
}
