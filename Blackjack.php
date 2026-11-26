<?php

require_once __DIR__ . '/Card.php';

class Blackjack
{
    public function scoreHand(array $hand): string
    {
        $totaal = 0;
        foreach ($hand as $card) {
            $totaal += $card->score();
        }
        $aantal = count($hand);

        if ($totaal > 21) {
            return 'Busted';
        }
        if ($totaal === 21 && $aantal === 2) {
            return 'Blackjack';
        }
        if ($totaal === 21) {
            return 'Twenty-One';
        }
        if ($aantal >= 5) {
            return 'Five Card Charlie';
        }

        return (string) $totaal;
    }
}
