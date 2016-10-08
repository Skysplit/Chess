<?php

namespace Chess\Figures;
use Chess\AbstractFigure;
use Chess\Interfaces\Figure as FigureInterface;
use Chess\Interfaces\Figures\King as KingInterface;
use Chess\Interfaces\Figures\Castles;
use Chess\Traits\Figures\Moves\Askew;
use Chess\Traits\Figures\Moves\Alongside;

class King extends AbstractFigure implements KingInterface
{
    use Askew, Alongside;

    /**
     * @inheritDoc
     */
    public function id(): string
    {
        return 'k';
    }

    /**
     * @inheritDoc
     */
    public function canMoveTo(string $x, int $y): bool
    {
        $rangeX = range($this->x, $x);
        $countX = count($rangeX) - 1;
        $countY = abs($this->y - $y);
        $enemyFigures = $this->flattenBoardFields();

        if (
            $countX <= 1
            &&
            $countY <= 1
            &&
            (
                $this->canMoveAskew($x, $y)
                ||
                $this->canMoveAlongside($x, $y)
            )
            &&
            ! $this->isCheckedBy($enemyFigures, $x, $y)
        ) {
            return true;
        }

        if ($this->canPerformCastling($enemyFigures, $x, $y)) {
            return true;
        }

        return false;
    }

    public function isMoveCastling(string $x, int $y): bool
    {
        return $this->getDistance($x, $y) === 2;
    }


    protected function getDistance(string $x, int $y)
    {
        return count(range($x, $y)) - 1;
    }

    /**
     * Determine wheter figure is checked
     *
     * @param mixed  $enemyFigures
     * @param string $x
     * @param int    $y
     *
     * @return bool
     */
    protected function isCheckedBy($enemyFigures, string $x, int $y): bool
    {
        foreach ($enemyFigures as $figure) {
            if ($figure->canMoveTo($x, $y)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns array of enemy figures that are on board
     *
     * @return FigureInterface[]
     */
    protected function flattenBoardFields()
    {
        // Get every field
        $fields = $this->board->fields();

        // Remove current figure
        unset($fields[$this->x][$this->y]);

        // Flatten array
        $flat = call_user_func_array('array_merge', $fields);

        // Filter empty fields and return only enemy figures
        $flat = array_filter($flat, function ($figure) {
            /** @var FigureInterface|null $figure */
            return $figure !== null && $figure->getPlayer() !== $this->getPlayer();
        });

        return $flat;
    }

    protected function whichFigureCastlingIsPossbleWith($enemyFigures, string $x, int $y)
    {
        $border = $this->board->height();

        if ($this->getPlayer()->doesMoveUpwards()) {
            $border = $border[0];
        } else {
            $border = end($border);
        }

        if ($y !== $border) {
            return false;
        }

        $border = $this->board->width();
        $border = [
            $border[0],
            end($border),
        ];

        foreach ($border as $toX) {
            $castlingFigure = $this->board->get($toX, $y);

            if ($castlingFigure === null || ! $castlingFigure instanceof Castles) {
                continue;
            }
        }
    }
}
