<?php

namespace Chess\Interfaces\Figures;

/**
 * Figures that can be promoted should implement this interface
 */
interface Promotes
{
    /**
     * Checks if figure can be promoted when moved to given field
     *
     * @param string $x
     * @param int    $y
     *
     * @return bool
     */
    public function canPromote(string $x, int $y) : bool;
}
