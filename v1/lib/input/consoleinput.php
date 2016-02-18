<?php
/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

require_once __DIR__."/../baseinput.php";
require_once __DIR__."/../gamefield.php";

/**
 * This plugin asks the user over the console to specify the width/height of the gamefield and which cells sets should be set alive.
 * To use it, just set 'console' as --input parameter.
 */
class ConsoleInput extends BaseInput
{

    /**
     * The constructor asks for the width and height of the gamefield to create it in the parent constructor.
     *
     * @param array|null $_config No config is needed here.
     */
    public function __construct(array $_config = null)
    {
        echo "Please enter the width of the gamefield\n";
        $this->width = stream_get_line(STDIN, 1024, PHP_EOL);
        echo "Please enter the height of the gamefield\n";
        $this->height = stream_get_line(STDIN, 1024, PHP_EOL);

        parent::__construct($_config);
    }

    /**
     * This function asks for the number and x/y coordinates of the cells that should be set alive.
     */
    protected function setCells()
    {
        echo "How many cells do you want to set?\n";
        $numCells = stream_get_line(STDIN, 1024, PHP_EOL);

        for ($i = 0; $i < $numCells; $i++)
        {
            echo "Please enter the x coordinate of the cell\n";
            $x = stream_get_line(STDIN, 1024, PHP_EOL);
            echo "Please enter the y coordinate of the cell\n";
            $y = stream_get_line(STDIN, 1024, PHP_EOL);

            $this->getGameField()->getCellByCoords($x,$y)->life();
            echo "Cell ".$x."|".$y." set alive\n";
        }
    }
}