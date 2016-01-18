<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 15.01.2016
 * Time: 12:02
 */
class GameField
{
    /** @var  Cell[] */
    private $cells;

    public function __construct($_cells)
    {
        $this->cells = $_cells;
    }

    public function __clone()
    {
        foreach($this->cells as $key => $cell)
        {
            $this->cells[$key] = clone $cell;
        }
    }

    public function getCells()
    {
        return $this->cells;
    }

    public function getCellByCoords($_y, $_x)
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

    public function getNeighboursByCell(Cell $cell)
    {
        $y = $cell->getCoordY();
        $x = $cell->getCoordX();
        $neighbours = 0;

        for($nX = $x-1; $nX<=$x+1; $nX++)
        {
            for($nY = $y-1; $nY<=$y+1; $nY++)
            {
                if ($this->getCellByCoords($nY,$nX) && !($nX == $x && $nY == $y))
                {
                    if ($this->getCellByCoords($nY,$nX)->isAlive == 1) $neighbours++;
                }
            }
        }

        return $neighbours;
    }
}