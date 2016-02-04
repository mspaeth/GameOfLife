<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 15.01.2016
 * Time: 12:01
 *
 * Class of a single cell of the the gamefield!
 */
class Cell
{
    private $y;
    private $x;

    private $isAlive;

    /**
     * Cell constructor.
     * @param $_y int Y coord of the cell.
     * @param $_x int X coord of the cell.
     * @param $_isAlive int Returns true if cell is alive, false if cell is dead.
     */
    public function __construct($_x, $_y, $_isAlive)
    {
        $this->y = $_y;
        $this->x = $_x;
        $this->isAlive = $_isAlive;
    }

    /**
     * Returns the Y coordinate of the cell.
     * @return int Y coordinate of cell.
     */
    public function getCoordY()
    {
        return $this->y;
    }

    /**
     * Returns the X coordinate of the cell.
     * @return int X coordinate of the cell.
     */
    public function getCoordX()
    {
        return $this->x;
    }

    public function life()
    {
        $this->isAlive = true;
    }

    public function dead()
    {
        $this->isAlive = false;
    }

    public function isAlive()
    {
        return $this->isAlive;
    }
}