<?php

namespace Chess\Interfaces;

interface Move
{
    public function __construct(Board $board, Player $player, string $from);
    public function from(string $from);
    public function to(string $to);
    public function promotes(string $figure);
}
