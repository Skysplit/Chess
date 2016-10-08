<?php

namespace Chess\Figures;

use Chess\AbstractFigure;
use Chess\Traits\Figures\Moves\Askew;

class Bishop extends AbstractFigure
{
    use Askew;

    /**
     * {@inheritdoc}
     */
    public function id(): string
    {
        return 'b';
    }

    /**
     * {@inheritdoc}
     */
    public function canMoveTo(string $x, int $y): bool
    {
        if (! $this->canMoveAskew($x, $y)) {
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
}
