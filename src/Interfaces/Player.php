<?php

namespace Chess\Interfaces;

interface Player
{
    /**
     * Player constructor
     *
     * @param MovesManager $manager Player's moves manager
     */
    public function __construct(MovesManager $manager);

    /**
     * Get player id
     *
     * @return string
     */
    public function id() : string;

    /**
     * @return MovesManager|null
     */
    public function move();

    /**
     * Set if player moves upwards or downwards y-axis
     *
     * @param bool $flag true means player plays towards y-axis (y should ascend)
     */
    public function setMovesUpwards(bool $flag = true);

    /**
     * Check if players moves upwards y-axis
     *
     * @return bool
     */
    public function doesMoveUpwards() : bool;
}
