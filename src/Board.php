<?php

namespace Chess;

use ReflectionClass;
use Chess\Exceptions\BoardException;
use Chess\Interfaces\Board as BoardInterface;
use Chess\Interfaces\Player as PlayerInterface;
use Chess\Interfaces\Figure as FigureInterface;

class Board implements BoardInterface
{
    /**
     * @var array
     */
    protected $fields;

    /**
     * @var string[]
     */
    protected $width;

    /**
     * @var int[]
     */
    protected $height;

    /**
     * @var FigureInterface[]
     */
    protected $stack;

    /**
     * {@inheritdoc}
     */
    public function __construct(string $width = 'h', int $height = 8)
    {
        $this->width = range('a', $width);
        $this->height = range(1, $height);

        foreach ($this->width as $x) {
            foreach ($this->height as $y) {
                $this->fields[$x][$y] = null;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function fields(): array
    {
        return $this->fields;
    }

    /**
     * {@inheritdoc}
     */
    public function width(): array
    {
        return $this->width;
    }

    /**
     * {@inheritdoc}
     */
    public function height(): array
    {
        return $this->height;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(array $fields)
    {
        $this->fields = array_replace_recursive($this->fields, $fields);
    }

    /**
     * {@inheritdoc}
     */
    public function add(string $x, int $y, PlayerInterface $player, $figure)
    {
        if (is_string($figure) && ! class_exists($figure)) {
            throw new BoardException("Class {$figure} does not exists");
        }

        $reflection = new ReflectionClass($figure);
        $figureInterface = FigureInterface::class;

        if (! $reflection->implementsInterface($figureInterface)) {
            throw new BoardException("Class {$figure} must implement {$figureInterface}");
        }

        /** @var FigureInterface $figure */
        if (is_string($figure)) {
            $figure = new $figure($x, $y, $this, $player);
        }

        $this->set($x, $y, $figure);
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $x, int $y, FigureInterface $figure)
    {
        if (! $this->isFieldInBoundaries($x, $y)) {
            throw new BoardException("Field {$x}{$y} is not in board boundaries");
        }

        $figure->setX($x);
        $figure->setY($y);

        $this->fields[$x][$y] = $figure;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $x, int $y)
    {
        if (! $this->isFieldInBoundaries($x, $y)) {
            throw new BoardException("Field {$x}{$y} is not in board boundaries");
        }

        return $this->fields[$x][$y];
    }

    /**
     * {@inheritdoc}
     */
    public function remove(string $x, int $y)
    {
        $this->fields[$x][$y] = null;
    }

    /**
     * {@inheritdoc}
     */
    public function stack(string $x, int $y)
    {
        $figure = $this->get($x, $y);
        $this->remove($x, $y);

        $playerIdentifier = $figure->getPlayer()->id();
        $figureClass = get_class($figure);

        if (! isset($this->stack[$playerIdentifier][$figureClass])) {
            $this->stack[$playerIdentifier][$figureClass] = [];
        }

        $this->stack[$playerIdentifier][$figureClass][] = $figure;
    }

    /**
     * {@inheritdoc}
     */
    public function unstack(PlayerInterface $player, string $figure) : FigureInterface
    {
        $playerIdentifier = $player->id();

        if (empty($this->stack[$playerIdentifier][$figure])) {
            throw new BoardException('Figures stack is empty');
        }

        return array_shift($this->stack[$playerIdentifier][$figure]);
    }

    /**
     * @param string $x
     * @param int    $y
     * @return bool
     */
    protected function isFieldInBoundaries(string $x, int $y)
    {
        return in_array($x, $this->width, true) && in_array($y, $this->height, true);
    }
}
