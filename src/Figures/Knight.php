<?php

namespace Chess\Figures;
use Chess\AbstractFigure;

class Knight extends AbstractFigure
{
    /**
     * @inheritDoc
     */
    public function id(): string
    {
        return 'n';
    }

    /**
     * @inheritDoc
     */
    public function canMoveTo(string $x, int $y): bool
    {
        $rangeX = range($this->x, $x);
        $rangeY = range($this->y, $y);

        array_shift($rangeX);
        array_shift($rangeY);

        $countX = count($rangeX);
        $countY = count($rangeY);

        $figure = $this->board->get($x, $y);

        if (
            (
                ($countX === 2 && $countY === 1)
                ||
                ($countY === 2 && $countX === 1)
            )
            &&
            (
                $figure === null
                ||
                $figure->getPlayer() !== $this->getPlayer()
            )
        ) {
            return true;
        }

        return false;
    }

}
