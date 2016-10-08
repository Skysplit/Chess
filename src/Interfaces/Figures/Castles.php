<?php

namespace Chess\Interfaces\Figures;

/**
 * Implement this feature if figure can perform castling
 */
interface Castles
{
    /**
     * Whether figure is allowed to castle.
     * It should not check if the castle is possible at all,
     * but whether figure is allowed to perform castling
     *
     * @return bool
     */
    public function canCastle() : bool;
}
