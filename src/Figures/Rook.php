<?php

namespace Chess\Figures;

use Chess\AbstractFigure;
use Chess\Interfaces\Figures\Castles;
use Chess\Traits\Figures\Moves\Alongside;

class Rook extends AbstractFigure implements Castles
{
    use Alongside;

    /**
     * {@inheritdoc}
     */
    public function id(): string
    {
        return 'r';
    }

    /**
     * {@inheritdoc}
     */
    public function canMoveTo(string $x, int $y): bool
    {
        if (! $this->canMoveAlongside($x, $y)) {
            return false;
        }

        // Get field from board
        $figure = $this->board->get($x, $y);

        // Check if figure on field belongs to current player or field is empty
        if ($figure === null || $figure->getPlayer() !== $this->getPlayer()) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function canCastle(string $x, int $y): bool
    {
        $border = $this->board->height();

        if ($this->getPlayer()->doesMoveUpwards()) {
            $border = array_shift($border);
        } else {
            $border = array_pop($border);
        }

        return $this->y === $border && ! $this->wasMoved();
    }
}
