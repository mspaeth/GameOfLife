<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 15.01.2016
 * Time: 12:01
 */


class GameFieldController
{
    private $gameField;

    public function __construct($_gameField)
    {
        $this->gameField = $_gameField;
    }

    public function run()
    {
        $currentGameField = unserialize(serialize($this->gameField));

        foreach ($currentGameField->getCells() as $cell)
        {
            if ($cell->isAlive == 0)
            {
                if($currentGameField->getNeighboursByCell($cell) == 3) $this->gameField->getCellByCoords($cell->getCoordY(),$cell->getCoordX())->isAlive=1;
            }
            if ($cell->isAlive == 1)
            {
                if($currentGameField->getNeighboursByCell($cell) < 2) $this->gameField->getCellByCoords($cell->getCoordY(),$cell->getCoordX())->isAlive=0;
                elseif($currentGameField->getNeighboursByCell($cell) == 2) $this->gameField->getCellByCoords($cell->getCoordY(),$cell->getCoordX())->isAlive=1;
                elseif($currentGameField->getNeighboursByCell($cell) == 3) $this->gameField->getCellByCoords($cell->getCoordY(),$cell->getCoordX())->isAlive=1;
                elseif($currentGameField->getNeighboursByCell($cell) > 3) $this->gameField->getCellByCoords($cell->getCoordY(),$cell->getCoordX())->isAlive=0;
            }
        }
        return true;
    }

    public function getGameField()
    {
        return $this->gameField;
    }
}