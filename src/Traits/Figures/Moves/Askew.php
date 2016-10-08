<?php

namespace Chess\Traits\Figures\Moves;

trait Askew
{
    public function canMoveAskew(string $x, int $y)
    {
        $rangeX = range($this->x, $x);
        $rangeY = range($this->y, $y);

        // Remove first values
        array_shift($rangeX);
        array_shift($rangeY);

        // Remove last values
        array_pop($rangeX);
        array_pop($rangeY);

        // Count range size
        $countX = count($rangeX);
        $countY = count($rangeY);

        // Check if figure was moved askew
        if ($countX !== $countY) {
            return false;
        }

        // Check if there are any other figures on bishop's way
        for ($i = 0; $i < $countX; $i++) {
            $figure = $this->board->get($rangeX[$i], $rangeY[$i]);

            if ($figure !== null) {
                return false;
            }
        }

        return true;
    }
}
