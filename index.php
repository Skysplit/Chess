<?php

require 'vendor/autoload.php';

function dd()
{
    call_user_func_array('dump', func_get_args());
    die();
}

// Initialize board
$board = new Chess\Board();

// Initialize board moves manager
$movesFactory = new Chess\MovesManagerFactory($board);
$playerFactory = new Chess\PlayerFactory($movesFactory);

// Create players
$playerOne = $playerFactory->make();
$playerTwo = $playerFactory->make();

// Create players manager
$players = new Chess\PlayersManager($playerOne, $playerTwo);

// Initialize figures
$board->add('e', 1, $playerOne, Chess\Figures\King::class);
$board->add('h', 1, $playerOne, Chess\Figures\Rook::class);
$board->add('a', 1, $playerOne, Chess\Figures\Rook::class);
$board->add('d', 8, $playerTwo, Chess\Figures\Queen::class);

// Create game
$game = new Chess\Game($board, $players);

$game->player('whites')->move()->from('e1')->to('c1');

dd($game);
