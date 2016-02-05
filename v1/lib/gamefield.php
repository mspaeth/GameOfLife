<?php
/**
 * @file
 * @version 2.8
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

require_once "cell.php";

/**
 * This class is the gamefield which contains an array of cells.
 */
class GameField
{
    /** @var  Cell[] */
    private $cells;
    private $width;
    private $height;

    /**
     * GameField constructor.
     *
     * @param int $_width Width of the gamefield (x-axis)
     * @param int $_height Height of the gamefield (y-axis)
     */
    public function __construct($_width, $_height)
    {
        $this->width = $_width;
        $this->height = $_height;
        $this->cells = array();
        $this->createCells();
    }

    /**
     * Creates the array of cells which is the gamefield.
     */
    private function createCells()
    {
        for ($i=0; $i<$this->height; $i++)
        { // Create columns
            for ($j=0; $j<$this->width; $j++)
            { // Create rows
                $this->cells[] = new Cell($j,$i,0);
            }
        }
    }
    /**
     * Necessary for deep cloning the gamefield.
     */
    public function __clone()
    {
        foreach($this->cells as $key => $cell)
        {
            $this->cells[$key] = clone $cell;
        }
    }

    /**
     * Returns array of cells.
     * @return Cell[]
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * Searches for a cell with the given coordinates and returns it.
     * If the cell doesn't exist, it returns null.
     * @param $_y int Y coordinate of the cell.
     * @param $_x int X coordinate of the cell.
     * @return Cell|null
     */
    public function getCellByCoords($_x, $_y)
    {
        $cellByCord = NULL;

        foreach ($this->cells as $cell)
        {
            if ($cell->getCoordY() == $_y && $cell->getCoordX() == $_x)
            {
                $cellByCord = $cell;
            }
        }
        return $cellByCord;
    }

    /**
     * Calculates the neighbours of a given cell.
     * @param Cell $cell The cell the neighbours should be calculated for.
     * @return int Amount of neighbours.
     */
    public function getNeighboursByCell(Cell $cell)
    {
        $y = $cell->getCoordY();
        $x = $cell->getCoordX();
        $neighbours = 0;

        for($nY = $y-1; $nY<=$y+1; $nY++)
        {
            for($nX = $x-1; $nX<=$x+1; $nX++)
            {
                if ($this->getCellByCoords($nX,$nY) && !($nX == $x && $nY == $y))
                {
                    if ($this->getCellByCoords($nX,$nY)->isAlive()) $neighbours++;
                }
            }
        }

        return $neighbours;
    }

    /**
     * Returns the length of the y-axis of the gamefield.
     * @return int Height of the gamefield.
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Returns the length of the x-axis of the gamefield.
     * @return int Width of the gamefield.
     */
    public function getWidth()
    {
        return $this->width;
    }
}