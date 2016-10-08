<?php

namespace Chess\Interfaces;

interface PlayersManager
{
    /**
     * @param Player $whites white figures player
     * @param Player $blacks black figures player
     */
    public function __construct(Player $whites, Player $blacks);

    /**
     * Gets player instance
     *
     * @param string $key Usually either 'whites' or 'blacks'. Could vary on implementation
     *
     * @return Player
     */
    public function get(string $key) : Player;
}
