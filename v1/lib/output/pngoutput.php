<?php

/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

require_once __DIR__."/../pngcreator.php";
require_once __DIR__."/../baseoutput.php";

/**
 * This class inherits from the BaseOutput class, so we need to implement the output() function here, which will save the gamefield every cylce as png file.
 */
class PngOutput extends BaseOutput
{
    /**
     * This function is extended from the baseoutput class.
     * It creates and saves the gamefield each cycle as png file to /v1/tmp/png.
     *
     * @param GameFieldController $_gameFieldController The gamefieldcontroller which contains the gamefield.
     * @param int $_numCycles The amount of rounds the game should be played.
     */
    public function output(GameFieldController $_gameFieldController, $_numCycles)
    {
        $pngCreator = new PngCreator;

        for ($cycle = 0; $cycle<$_numCycles; $cycle++)
        { // Amount of cycles
            $pngCreator->createPng($_gameFieldController->getGameField(),$cycle);
            $_gameFieldController->run();
        }
    }
}