<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 05.02.2016
 * Time: 09:57
 */
require_once 'baseOutput.php';

class ConsoleOutput extends BaseOutput
{
    public function output(GameFieldController $_gameFieldController, $_cycle)
    {
        $cycle = $_cycle;
        $gameFieldController = $_gameFieldController;
        $x = $gameFieldController->getGameField()->getWidth();
        $y = $gameFieldController->getGameField()->getHeight();

        for ($numCycles = 0; $numCycles<$cycle; $numCycles++)
        {
            // Make columns
            for($i=0; $i<$y; $i++)
            {
                // Make rows
                for($j=0; $j<$x; $j++)
                {
                    if ($gameFieldController->getGameField()->getCellByCoords($j,$i)->isAlive()) echo "1";
                    else echo "0";
                }
                echo "\n";
            }
            echo "---------------------\n";

            $gameFieldController->run();
        }
    }
}