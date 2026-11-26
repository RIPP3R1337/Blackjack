<?php

require_once __DIR__ . '/Card.php';

class Player
{
    private string $name;
    private array $hand = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addCard(Card $card)
    {
        $this->hand[] = $card;
    }

    public function showHand(): string
    {
        $tekst = $this->name . " heeft";

        foreach ($this->hand as $card) {
            $tekst .= " " . $card->show();
        }

        return $tekst;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function hand(): array
    {
        return $this->hand;
    }
}
