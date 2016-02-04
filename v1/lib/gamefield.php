<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 15.01.2016
 * Time: 12:02
 */
require_once "cell.php";

class GameField
{
    /** @var  Cell[] */
    private $cells;
    private $width;
    private $height;

    /**
     * GameField constructor.
     * @param $_cells cell[] Array which contains instances of cell.
     */
    public function __construct($_width, $_height)
    {
        $this->width = $_width;
        $this->height = $_height;
        $this->cells = array();
        $this->createCells();
    }

    private function createCells()
    {
        // Make columns
        for($i=0; $i<$this->height; $i++)
        {
            // Make rows
            for($j=0; $j<$this->width; $j++)
            {
                $cell = new Cell($j,$i,0);
                $this->cells[] = $cell;
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
}