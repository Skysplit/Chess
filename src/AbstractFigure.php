<?php

namespace Chess;

use Chess\Interfaces\Board as BoardInterface;
use Chess\Interfaces\Player as PlayerInterface;
use Chess\Interfaces\Figure;

abstract class AbstractFigure implements Figure
{
    /**
     * Board that figure belongs to.
     *
     * @var BoardInterface
     */
    protected $board;

    /**
     * Owner of the figure.
     *
     * @var PlayerInterface
     */
    protected $player;

    /**
     * Current figure x-axis position.
     *
     * @var string
     */
    protected $x;

    /**
     * Current figure y-axis position.
     *
     * @var int
     */
    protected $y;

    /**
     * Figure starting x-axis position.
     *
     * @var string
     */
    protected $startX;

    /**
     * Figure starting y-axis postion.
     *
     * @var int
     */
    protected $startY;

    /**
     * Determines if figure was moved.
     *
     * @var bool
     */
    protected $wasMoved = false;

    /**
     * {@inheritdoc}
     */
    public function __construct(string $x, int $y, BoardInterface $board, PlayerInterface $player)
    {
        $this->x = $this->startX = $x;
        $this->y = $this->startY = $y;
        $this->board = $board;
        $this->player = $player;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlayer() : PlayerInterface
    {
        return $this->player;
    }

    /**
     * {@inheritdoc}
     */
    public function isAttack(string $x, int $y) : bool
    {
        $figure = $this->board->get($x, $y);

        return $figure !== null && $this->player !== $figure->getPlayer();
    }

    /**
     * {@inheritdoc}
     */
    public function setX(string $x)
    {
        if ($x !== $this->x) {
            $this->wasMoved = true;
            $this->x = $x;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setY(int $y)
    {
        if ($y !== $this->y) {
            $this->wasMoved = true;
            $this->y = $y;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function wasMoved(): bool
    {
        return $this->wasMoved;
    }
}
