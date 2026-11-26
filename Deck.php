<?php

require_once __DIR__ . '/Card.php';

class Deck
{
    private array $cards = [];

    public function __construct()
    {
        $soorten = ['harten', 'ruiten', 'klaveren', 'schoppen'];
        $waarden = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'boer', 'vrouw', 'heer', 'aas'];

        foreach ($soorten as $soort) {
            foreach ($waarden as $waarde) {
                $this->cards[] = new Card($soort, $waarde);
            }
        }
        shuffle($this->cards);
    }

    public function drawCard(): Card
    {
        if (count($this->cards) === 0) {
            throw new Exception('Het deck is leeg');
        }

        return array_pop($this->cards);
    }
}
