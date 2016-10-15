<?php

namespace Chess;

use Chess\Exceptions\PlayerException;
use Chess\Interfaces\PlayersManager as PlayersManagerInterface;
use Chess\Interfaces\Player as PlayerInterface;

class PlayersManager implements PlayersManagerInterface
{
    /**
     * @var Players[]
     */
    protected $players;

    /**
     * @param Player $whites
     * @param Player $blacks
     */
    public function __construct(PlayerInterface $whites, PlayerInterface $blacks)
    {
        $whites->setMovesUpwards(true);
        $blacks->setMovesUpwards(false);

        $this->players = compact('whites', 'blacks');
    }

    /**
     * @param string $key
     * @return Player
     *
     * @throws PlayerException
     */
    public function get(string $key) : PlayerInterface
    {
        if (! array_key_exists($key, $this->players)) {
            throw new PlayerException("Player key {$key} is invalid");
        }

        return $this->players[$key];
    }
}
