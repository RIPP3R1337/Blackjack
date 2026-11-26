<?php

class Card
{
    private string $suit;
    private string $value;

    private function validateSuit(string $suit): void
    {
        $geldigeSuits = [
            'harten',
            'klaveren',
            'ruiten',
            'schoppen',
        ];

        if (!in_array($suit, $geldigeSuits)) {
            throw new InvalidArgumentException('Ongeldige suit: ' . $suit);
        }
    }

    private function validateValue(string $value): void
    {
        $geldigeValues = [
            ...range(2, 10),
            'boer',
            'vrouw',
            'heer',
            'aas',
        ];

        if (!in_array($value, $geldigeValues)) {
            throw new InvalidArgumentException('Ongeldige value: ' . $value);
        }
    }

    public function __construct(string $suit, string $value)
    {
        $this->validateSuit($suit);
        $this->validateValue($value);
        $this->suit = $suit;
        $this->value = $value;
    }

    public function show(): string
    {
        $icoon = match ($this->suit) {
            'harten' => '♥',
            'klaveren' => '♣',
            'ruiten' => '♦',
            'schoppen' => '♠',
            default => '?',
        };

        $afkorting = match ($this->value) {
            'boer' => 'B',
            'vrouw' => 'V',
            'heer' => 'H',
            'aas' => 'A',
            default => $this->value,
        };
        return $icoon . $afkorting;
    }

    public function score(): int
    {
        return match ($this->value) {
            'boer', 'vrouw', 'heer' => 10,
            'aas' => 11,
            default => (int) $this->value,
        };
    }
}
