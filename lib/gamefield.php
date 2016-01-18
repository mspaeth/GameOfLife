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
        $positionHeight = $cell->getCoordY();
        $positionWidth = $cell->getCoordX();
        $neighbours = 0;

        if ($this->getCellByCoords($positionHeight+1,$positionWidth))
        {
            if ($this->getCellByCoords($positionHeight+1,$positionWidth)->isAlive == 1) $neighbours += 1;
        }
        if ($this->getCellByCoords($positionHeight+1,$positionWidth+1))
        {
            if ($this->getCellByCoords($positionHeight+1,$positionWidth+1)->isAlive == 1) $neighbours += 1;
        }
        if ($this->getCellByCoords($positionHeight+1,$positionWidth-1))
        {
            if ($this->getCellByCoords($positionHeight+1,$positionWidth-1)->isAlive == 1) $neighbours += 1;
        }
        if ($this->getCellByCoords($positionHeight-1,$positionWidth))
        {
            if ($this->getCellByCoords($positionHeight-1,$positionWidth)->isAlive == 1) $neighbours += 1;
        }
        if ($this->getCellByCoords($positionHeight-1,$positionWidth+1))
        {
            if ($this->getCellByCoords($positionHeight-1, $positionWidth+1)->isAlive == 1) $neighbours += 1;
        }
        if ($this->getCellByCoords($positionHeight-1,$positionWidth-1))
        {
            if ($this->getCellByCoords($positionHeight-1,$positionWidth-1)->isAlive == 1) $neighbours += 1;
        }
        if ($this->getCellByCoords($positionHeight,$positionWidth+1))
        {
            if ($this->getCellByCoords($positionHeight,$positionWidth+1)->isAlive == 1) $neighbours += 1;
        }
        if ($this->getCellByCoords($positionHeight,$positionWidth-1))
        {
            if ($this->getCellByCoords($positionHeight,$positionWidth-1)->isAlive == 1) $neighbours += 1;
        }

        return $neighbours;
    }
}