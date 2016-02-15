<?php

/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

require_once __DIR__."/../pngcreator.php";
require_once __DIR__."/../baseoutput.php";

class PngOutput extends BaseOutput
{
    /**
     * This function needs to be implemented in every plugin which extends from this class.
     * It gets the necessary parameters to output the gamefield.
     *
     * @param GameFieldController $_gameFieldController The gamefieldcontroller which contains the gamefield.
     * @param int $_numCycles The amount of rounds the game should be played.
     */
    public function output(GameFieldController $_gameFieldController, $_numCycles)
    {
        $pngCreator = new PngCreator;

        $pngCreator->createPng($_gameFieldController, $_numCycles);
    }
}