<?php
/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

require_once 'baseoutput.php';

/**
 * This class implements the output function from BaseOutput and prints the gamefield every cycle
 * to the console.
 */
class ConsoleOutput extends BaseOutput
{
    /**
     * This function is extended from the baseoutput class.
     * It prints the gamefield to the console for the number of cycles given.
     *
     * @param GameFieldController $_gameFieldController Object of gamefieldcontroller.
     * @param int $_numCycles Amount of rounds the game should be played.
     */
    public function output(GameFieldController $_gameFieldController, $_numCycles)
    {
        $numCycles = $_numCycles;
        $gameFieldController = $_gameFieldController;
        $x = $gameFieldController->getGameField()->getWidth();
        $y = $gameFieldController->getGameField()->getHeight();

        for ($cycle = 0; $cycle<$numCycles; $cycle++)
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