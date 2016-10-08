<?php

namespace Chess\Interfaces;

interface MovesManager
{
    public function __construct(Board $board);
    public function setPlayer(Player $player);
    public function getBoard() : Board;
    public function getPlayer() : Player;
    public function from(string $from) : Move;
    public function notation(string $value);
}
