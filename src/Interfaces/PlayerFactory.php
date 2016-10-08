<?php

namespace Chess\Interfaces;
use Chess\Interfaces\MovesManagerFactory;

interface PlayerFactory
{
    /**
     * @param MovesManagerFactory $manager Moves manager factory
     */
    public function __construct(MovesManagerFactory $manager);

    /**
     * Creates player instance using MovesManagerFactory from constructor
     * 
     * @return Player
     */
    public function make() : Player;
}
