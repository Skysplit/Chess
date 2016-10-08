Proof of concept

```php
<?php

// Create chess board
$board = new Chess\Board();

$playerOneMoves = new Chess\MovesManager($board);
$playerTwoMoves = new Chess\MovesManager($board);

// Create players
$playerOne = new Chess\Player($playerOneMoves);
$playerTwo = new Chess\Player($playerTwoMoves);

// Create players manager
$players = new Chess\PlayerManager($playerOne, $playerTwo)

// Fill board with players' figures
$board->merge(Chess\FieldsFactory::defaultFields($players))

$game = new Chess\Game($board, $players)

$game->player('whites')->move()->from('b1')->to('a3');
$game->player('whites')->move('na3')

```
