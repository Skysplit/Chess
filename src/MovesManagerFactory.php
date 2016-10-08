<?php

namespace Chess;

use Chess\Interfaces\MovesManagerFactory as MovesManagerFactoryInterface;
use Chess\Interfaces\Board as BoardInterface;
use Chess\Interfaces\MovesManager as MovesManagerInterface;

class MovesManagerFactory implements MovesManagerFactoryInterface
{
    /**
     * @var BoardInterface
     */
    protected $board;

    /**
     * {@inheritdoc}
     */
    public function __construct(BoardInterface $board)
    {
        $this->board = $board;
    }

    /**
     * {@inheritdoc}
     */
    public function make(): MovesManagerInterface
    {
        return new MovesManager($this->board);
    }
}
