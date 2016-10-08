<?php

namespace Chess\Interfaces\Figures;
use Chess\Interfaces\Figure;

/**
 * This interface should be implemented to king.
 * Stacking this figure should lead to victory of opposite player.
 */
interface King
{
    /**
     * Checks wheter move is castling
     *
     * @param string $x
     * @param int    $y
     *
     * @return bool
     */
    public function isMoveCastling(string $x, int $y): bool;
}
