# Blackjack (PHP OOP)

A simple command-line Blackjack game built in PHP as a school assignment for the Software Developer program at Bit-Academy. The goal was to practice object-oriented programming: classes, objects, encapsulation and dependency injection.

## How to play

Requires PHP 8.0 or higher.

```bash
php index.php
```

The dealer and players each get two cards. On your turn, type `d` (draw) for another card or `s` (stop) to hold. The dealer keeps drawing until it has 18 points or more.

Example:

```
Dealer heeft ♦3 ♥V
Dealer trekt ♠2
Ischa is aan de beurt. Ischa heeft ♦4 ♦5. 'draw' of 'stop'?... d
Ischa trekt ♥7
Merel is aan de beurt. Merel heeft ♥B ♣B. 'draw' of 'stop'?... s
Merel stopt.
```

## Rules

- Number cards are worth their value, face cards (B, V, H) are worth 10, and an ace is worth 11.
- More than 21 points means you're **Busted**.
- 21 points with your opening hand is a **Blackjack**, and the game ends immediately.
- Reaching exactly 21 is a **Twenty-One**.
- Five cards without going over 21 is a **Five Card Charlie**, and the game ends immediately.
- Each player plays against the dealer. A higher score than the dealer wins; a tie goes to the dealer.

## Project structure

| File | Responsibility |
|---|---|
| `Card.php` | A single card: suit, value, display and points |
| `Deck.php` | Creates and shuffles 52 cards, deals one at a time |
| `Player.php` | A player's name and hand |
| `Blackjack.php` | The scoring rules for a hand |
| `Dealer.php` | Runs the game: deals cards, asks players, decides the results |
| `index.php` | Starts a game |

## Author

Dylan Heller ([@RIPP3R1337](https://github.com/RIPP3R1337))
