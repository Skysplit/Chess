<?php

namespace Chess\Interfaces;

interface Board
{
    /**
     * Return board width (as width elements array)
     *
     * @return array
     */
    public function width() : array;

    /**
     * Return board height (as height elements array)
     *
     * @return array
     */

    public function height() : array;


    /**
     * Get two-dimensional array of board fields
     *
     * @return array
     */
    public function fields() : array;

    /**
     * Get figure that is on given field
     *
     * @param string $x
     * @param int    $y
     * @return Figure|null
     */
    public function get(string $x, int $y);


    /**
     * Places figure on given field
     *
     * @param string $x
     * @param int    $y
     * @param Figure $figure
     */
    public function set(string $x, int $y, Figure $figure);


    /**
     * Remove figure from field
     *
     * @param string $x
     * @param int    $y
     */
    public function remove(string $x, int $y);


    /**
     * Merge fields array with board's fields
     *
     * @param array $fields
     */
    public function merge(array $fields);


    /**
     * Move figure from given field to figures stack
     *
     * @param string $x
     * @param int    $y
     */
    public function stack(string $x, int $y);


    /**
     * Get figure of given class that belongs to a player from stack
     *
     * @param Player $player
     * @param string $figure
     *
     * @return Figure
     */
    public function unstack(Player $player, string $figure) : Figure;


    /**
     * Create instance of given figure, assign it to given player and place on given field
     *
     * @param string $x
     * @param int    $y
     * @param Player $player
     * @param mixed  $figure
     */
    public function add(string $x, int $y, Player $player, $figure);
};
