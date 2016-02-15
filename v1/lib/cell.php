<?php
/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

/**
 * This class represents a cell oject, which contains the information about whether it is dead or alive.
 */
class Cell
{
    private $y;
    private $x;

    private $isAlive;

    /**
     * Constructs the cell and sets the necessary member variables.
     *
     * @param $_y int Y coord of the cell.
     * @param $_x int X coord of the cell.
     * @param $_isAlive bool True if cell is alive, false if cell is dead.
     */
    public function __construct($_x, $_y, $_isAlive)
    {
        $this->y = $_y;
        $this->x = $_x;
        $this->isAlive = $_isAlive;
    }

    /**
     * Returns the Y coordinate of the cell.
     *
     * @return int Y coordinate of cell.
     */
    public function getCoordY()
    {
        return $this->y;
    }

    /**
     * Returns the X coordinate of the cell.
     *
     * @return int X coordinate of the cell.
     */
    public function getCoordX()
    {
        return $this->x;
    }

    /**
     * Change state of cell to be alive.
     */
    public function life()
    {
        $this->isAlive = true;
    }

    /**
     * Change state of cell to be dead.
     */
    public function dead()
    {
        $this->isAlive = false;
    }

    /**
     * Returns if the cell is alive or dead.
     *
     * @return bool Returns true if cell is alive, false if cell is dead.
     */
    public function isAlive()
    {
        return $this->isAlive;
    }
}