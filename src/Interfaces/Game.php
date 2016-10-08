<?php

namespace Chess\Interfaces;

interface Game
{
    /**
     * Game constructor.
     *
     * @param Board          $board Board that game is being played on
     * @param PlayersManager $players Players that participate in game
     */
    public function __construct(Board $board, PlayersManager $players);

    /**
     * Get board instance that game is being played on.
     *
     * @return Board
     */
    public function board() : Board;

    /**
     * Get player instance.
     *
     * @param string $key Usually either 'whites' or 'blacks'
     */
    public function player(string $key);
}
