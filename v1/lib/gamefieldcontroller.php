<?php
/**
 * @file
 * @version 2.8
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

class GameFieldController
{
    private $gameField;

    /**
     * GameFieldController constructor.
     * @param $_gameField gameField An instance of the gameField class.
     */
    public function __construct($_gameField)
    {
        $this->gameField = $_gameField;
    }

    /**
     * This function does the main game logic.
     * It calcualtes the amount of neighbours for each cell, and depending on the game rules sets the cell alive or dead.
     * @return bool
     */
    public function run()
    {
        $currentGameField = clone $this->gameField;

        foreach ($currentGameField->getCells() as $cell)
        {
            $neighbours = $currentGameField->getNeighboursByCell($cell);
            if (!$cell->isAlive())
            {
                if($currentGameField->getNeighboursByCell($cell) == 3) $this->gameField->getCellByCoords($cell->getCoordX(),$cell->getCoordY())->life();
            }
            if ($cell->isAlive())
            {
                if($neighbours == 2 || $neighbours == 3) $this->gameField->getCellByCoords($cell->getCoordX(),$cell->getCoordY())->life();
                else $this->gameField->getCellByCoords($cell->getCoordX(),$cell->getCoordY())->dead();
            }
        }
        return true;
    }

    /**
     * Returns the gameField.
     * @return gameField
     */
    public function getGameField()
    {
        return $this->gameField;
    }
}