<?php

require_once __DIR__ . '/Blackjack.php';
require_once __DIR__ . '/Card.php';
require_once __DIR__ . '/Dealer.php';
require_once __DIR__ . '/Deck.php';
require_once __DIR__ . '/Player.php';

$dealer = new Dealer(new Blackjack(), new Deck());
$dealer->addPlayer(new Player('Ischa'));
$dealer->addPlayer(new Player('Merel'));
$dealer->playGame();