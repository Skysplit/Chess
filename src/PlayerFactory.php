<?php

namespace Chess;

use Chess\Interfaces\PlayerFactory as PlayerFactoryInterface;
use Chess\Interfaces\MovesManagerFactory as MovesManagerFactoryInterface;
use Chess\Interfaces\Player as PlayerInterface;


class PlayerFactory implements PlayerFactoryInterface
{

    /**
     * @var MovesManagerFactoryInterface
     */
    protected $factory;

    /**
    * {@inheritdoc}
    */
    public function __construct(MovesManagerFactoryInterface $factory)
    {
        $this->factory = $factory;
    }


    /**
    * {@inheritdoc}
    */
    public function make(): PlayerInterface
    {
        return new Player($this->factory->make());
    }
}
