<?php

require_once __DIR__ . '/Blackjack.php';
require_once __DIR__ . '/Player.php';
require_once __DIR__ . '/Deck.php';

class Dealer
{
    private Blackjack $blackJack;
    private Deck $deck;
    private array $players = [];

    public function __construct(Blackjack $blackjack, Deck $deck)
    {
        $this->blackJack = $blackjack;
        $this->deck = $deck;

        $this->players[] = new Player('Dealer');
    }

    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    public function playGame()
    {
        $this->dealOpeningHands();

        if ($this->checkBlackjack()) {
            $this->showAllHands();
            return;
        }

        if ($this->playRounds()) {
            $this->showAllHands();
            return;
        }

        $this->showResults();
    }

    private function dealOpeningHands()
    {
        foreach ($this->players as $player) {
            $this->giveCard($player);
            $this->giveCard($player);
        }
    }

    private function giveCard(Player $player): Card
    {
        $card = $this->deck->drawCard();
        $player->addCard($card);

        return $card;
    }

    private function getScore(Player $player): string
    {
        return $this->blackJack->scoreHand($player->hand());
    }

    private function checkBlackjack(): bool
    {
        foreach ($this->players as $player) {
            if ($this->getScore($player) === 'Blackjack') {
                echo $player->name() . " wint! Blackjack!\n";
                return true;
            }
        }

        return false;
    }

    private function playRounds(): bool
    {
        $gestopt = [];

        while (count($gestopt) < count($this->players)) {
            foreach ($this->players as $index => $player) {
                if (isset($gestopt[$index])) {
                    continue;
                }

                if ($index === 0) {
                    $wilKaart = $this->dealerWantsCard($player);
                } else {
                    $wilKaart = $this->playerWantsCard($player);
                }

                if (!$wilKaart) {
                    $gestopt[$index] = true;
                    continue;
                }

                $card = $this->giveCard($player);
                echo $player->name() . " trekt " . $card->show() . "\n";

                $score = $this->getScore($player);

                if ($score === 'Five Card Charlie') {
                    echo $player->name() . " wint! Five Card Charlie!\n";
                    return true;
                }

                if (!is_numeric($score)) {
                    echo $player->name() . ": " . $score . "\n";
                    $gestopt[$index] = true;
                }
            }
        }

        return false;
    }

    private function dealerWantsCard(Player $dealer): bool
    {
        echo $dealer->showHand() . "\n";

        if ((int) $this->getScore($dealer) < 18) {
            return true;
        }

        echo "Dealer stopt.\n";
        return false;
    }

    private function playerWantsCard(Player $player): bool
    {
        while (true) {
            echo $player->name() . " is aan de beurt. " . $player->showHand() . ". 'draw' of 'stop'?... ";
            $input = fgets(STDIN);

            $keuze = $input === false ? 's' : strtolower(trim($input));

            if ($keuze === 'd' || $keuze === 'draw') {
                return true;
            }
            if ($keuze === 's' || $keuze === 'stop') {
                echo $player->name() . " stopt.\n";
                return false;
            }
        }
    }

    private function points(Player $player): int
    {
        return match ($this->getScore($player)) {
            'Busted' => 0,
            'Twenty-One' => 21,
            default => (int) $this->getScore($player),
        };
    }

    private function showResults()
    {
        echo "\n--- Uitslag ---\n";
        $this->showAllHands();
        echo "\n";

        $dealerPunten = $this->points($this->players[0]);

        foreach ($this->players as $index => $player) {
            if ($index === 0) {
                continue;
            }

            $spelerPunten = $this->points($player);

            if ($spelerPunten > $dealerPunten) {
                echo $player->name() . " wint van de dealer!\n";
            } else {
                echo "Dealer wint van " . $player->name() . ".\n";
            }
        }
    }

    private function showAllHands()
    {
        foreach ($this->players as $player) {
            echo $player->showHand() . " -> " . $this->getScore($player) . "\n";
        }
    }
}
