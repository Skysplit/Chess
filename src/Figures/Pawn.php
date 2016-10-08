<?php

namespace Chess\Figures;

use Chess\AbstractFigure;
use Chess\Interfaces\Figures\Promotes;

class Pawn extends AbstractFigure implements Promotes
{
    /**
     * {@inheritdoc}
     */
    public function id(): string
    {
        return 'p';
    }

    /**
     * {@inheritdoc}
     */
    public function canMoveTo(string $x, int $y) : bool
    {
        // Check if pawn is moving forward
        if (! $this->movesForward()) {
            return false;
        }

        // Get move diff
        $diff = abs($this->y - $y);

        // Get figure on requested field
        $figure = $this->board->get($x, $y);

        // We're checking possibilities of straight move first
        if ($x === $this->x) {
            // Check if the field is already taken
            if ($figure !== null) {
                return false;
            }

            // Starting move - 2 fields up
            if ((! $this->wasMoved() && $diff === 2) || $diff === 1) {
                return true;
            }

            return false;
        }

        // Copy coordinates so we can increment/decrement safely
        $leftX = $this->x;
        $rightX = $this->x;

        // We're incrementing/decrementing letters
        // PHP has pretty convenient way to do it (fortunately)
        $leftX++;
        $rightX--;

        // Check one field forward askew (attack)
        if (
            $diff === 1
            && ($x === $leftX || $x === $rightX)
            && ($leftX !== $this->x || $rightX !== $thix->x)
            && $figure !== null
            && $figure->getPlayer() !== $this->player
        ) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function canPromote(string $x, int $y) : bool
    {
        $border = $this->board->height();

        if ($this->getPlayer()->doesMoveUpwards()) {
            $border = end($border);
        } else {
            $border = $border[0];
        }

        if ($y === $border) {
            return true;
        }

        return false;
    }

    /**
     * Check whether pawn moves forward
     *
     * @param string $x
     * @param int    $y
     */
    protected function movesForward(string $x, int $y)
    {
        if ($this->getPlayer()->doesMoveUpwards()) {
            if ($y < $this->y) {
                return false;
            }
        } else {
            if ($y > $this->y) {
                return false;
            }
        }

        return true;
    }
}
