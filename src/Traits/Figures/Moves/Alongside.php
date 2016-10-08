<?php

namespace Chess\Traits\Figures\Moves;

trait Alongside
{
    public function canMoveAlongside(string $x, int $y)
    {
        if ($x !== $this->x && $y !== $this->y) {
            return false;
        }

        $rangeX = range($this->x, $x);
        $rangeY = range($this->y, $y);

        // Remove first (current position) and last (destination) elements from range (path)
        if ($this->y !== $y) {
            array_shift($rangeY);
            array_pop($rangeY);
        } else {
            array_shift($rangeX);
            array_pop($rangeX);
        }

        // Check if there are any figures in rooks path
        foreach ($rangeX as $toX) {
            foreach ($rangeY as $toY) {
                $figure = $this->board->get($toX, $toY);

                if ($figure !== null) {
                    return false;
                }
            }
        }

        return true;
    }
}
