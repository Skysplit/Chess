<?php

namespace Chess;

use ReflectionClass;
use Chess\Interfaces\Board as BoardInterface;
use Chess\Interfaces\Player as PlayerInterface;
use Chess\Interfaces\Move as MoveInterface;
use Chess\Interfaces\Figure as FigureInterface;
use Chess\Interfaces\Figures\Promotes;

class Move implements MoveInterface
{
    /**
     * @var BoardInterface
     */
    protected $board;

    /**
     * @var PlayerInterface
     */
    protected $player;

    /**
     * @var string
     */
    protected $from;

    /**
     * @var string
     */
    protected $promotes = null;

    /**
     * @param BoardInterface  $board
     * @param PlayerInterface $player
     * @param string          $frm
     */
    public function __construct(BoardInterface $board, PlayerInterface $player, string $from)
    {
        $this->board = $board;
        $this->player = $player;
        $this->from = $from;
    }

    /**
     * {@inheritdoc}
     */
    public function to(string $to)
    {
        $from = $this->splitCords($this->from);
        $to = $this->splitCords($to);

        list($fromX, $fromY) = $from;
        list($toX, $toY) = $to;

        $fromY = (int) $fromY;
        $toY = (int) $toY;

        if ($fromX === $toX && $fromY === $toY) {
            die('No move was made');
        }

        $this->checkBoundaries($fromX, $fromY, $toX, $toY);

        $fromFigure = $this->board->get($fromX, $fromY);

        if ($fromFigure === null) {
            die('Could not find figure on '.$fromX.$fromY);
        }

        if ($fromFigure->getPlayer() !== $this->player) {
            die('This figure does not belong to you');
        }

        if (! $fromFigure->canMoveTo($toX, $toY)) {
            die('You cannot move there');
        }


        $this->board->remove($fromX, $fromY);

        if ($fromFigure->isAttack($toX, $toY)) {
            $this->board->stack($toX, $toY);
        }

        if ($fromFigure instanceof Promotes && $fromFigure->canPromote($toX, $toY)) {
            dd('can promote');
        }

        $this->board->set($toX, $toY, $fromFigure);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function from(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function promotes(string $figure)
    {
        if (! class_exists($figure)) {
            die('class does not exist');
        }

        $reflection = new ReflectionClass($figure);

        if (! $reflection->implementsInterface(FigureInterface::class)) {
            die('class does not implements figure interface');
        }

        $this->promotes = $figure;

        return $this;
    }

    /**
     * @param string $value
     * @return array
     */
    protected function splitCords($value)
    {
        preg_match('/([a-z]+?)([1-9]+?)/', $value, $matches);

        // Drop first key
        array_shift($matches);

        // Check if cords are correct
        if (count($matches) !== 2 && is_string($matches[0]) && is_numeric($matches[1])) {
            die('Invalid cords');
        }

        return array_map('strtolower', $matches);
    }

    protected function checkBoundaries(string $fromX, int $fromY, string $toX, int $toY)
    {
        $width = $this->board->width();
        $height = $this->board->height();

        if (! in_array($fromX, $width, true) || ! in_array($fromY, $height, true)) {
            die('From is beyond board boundaries');
        }

        if (! in_array($toX, $width, true) || ! in_array($toY, $height, true)) {
            die('To is beyond board boundaries');
        }
    }
}
