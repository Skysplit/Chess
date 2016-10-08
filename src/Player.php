<?php

namespace Chess;

use Chess\Interfaces\Player as PlayerInterface;
use Chess\Interfaces\MovesManager as MovesManagerInterface;

class Player implements PlayerInterface
{
    /**
     * @var MovesManager
     */
    protected $manager;

    /**
     * @var bool
     */
    protected $movesUpwards = false;

    /**
     * Players counter so we can create unique id
     * It depends on implementation
     * Feel free to change it in your own implementation
     *
     * @var int
     */
    public static $playersCount = 1;

    /**
     * {@inheritdoc}
     */
    public function __construct(MovesManagerInterface $manager)
    {
        $this->manager = $manager;
        $this->manager->setPlayer($this);
        $this->id = self::$playersCount++;
    }

    /**
     * {@inheritdoc}
     */
    public function id() : string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function move(...$args)
    {
        $argc = count($args);

        if ($argc === 0) {
            return $this->manager;
        }

        return $this->manager->notation(array_shift($args));
    }

    /**
     * {@inheritdoc}
     */
    public function setMovesUpwards(bool $flag = true)
    {
        $this->movesUpwards = $flag;
    }

    /**
     * {@inheritdoc}
     */
    public function doesMoveUpwards(): bool
    {
        return $this->movesUpwards;
    }
}
