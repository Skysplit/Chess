<?php

namespace Chess;

use Chess\Interfaces\Board as BoardInterface;
use Chess\Interfaces\Player as PlayerInterface;
use Chess\Interfaces\Move as MoveInterface;
use Chess\Interfaces\MovesManager as MovesManagerInterface;

class MovesManager implements MovesManagerInterface
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
     * @param Board $board
     */
    public function __construct(BoardInterface $board)
    {
        $this->board = $board;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlayer(): PlayerInterface
    {
        return $this->player;
    }

    /**
     * {@inheritdoc}
     */
    public function setPlayer(PlayerInterface $player)
    {
        $this->player = $player;
    }

    /**
     * {@inheritdoc}
     */
    public function getBoard() : BoardInterface
    {
        return $this->board;
    }

    /**
     * {@inheritdoc}
     */
    public function from(string $from) : MoveInterface
    {
        return new Move($this->getBoard(), $this->getPlayer(), $from);
    }

    /**
     * {@inheritdoc}
     */
    public function notation(string $value)
    {
        throw new \LogicException('Notation movements are not implemented yet');
    }
}
