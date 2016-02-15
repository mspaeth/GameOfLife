<?php

/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

require_once __DIR__."/../pngcreator.php";
require_once __DIR__."/../GifCreator.php";
require_once __DIR__."/../baseoutput.php";

/**
 * This class inherits from the BaseOutput class, so we need to implement the output() function here, which will save the game cycles as a gif animation.
 */
class GifOutput extends BaseOutput
{
    /**
     * This function is extended from the baseoutput class.
     * It creates and saves the game cycles as a gif file to /v1/tmp/gif.
     *
     * @param GameFieldController $_gameFieldController The gamefieldcontroller which contains the gamefield.
     * @param int $_numCycles The amount of rounds the game should be played.
     */
    public function output(GameFieldController $_gameFieldController, $_numCycles)
    {
        $pngCreator = new PngCreator;
        $gifCreator = new GifCreator(0, 2, array(-1, -1, -1));

        for ($cycle = 0; $cycle<$_numCycles; $cycle++)
        { // Creates a png for each cycle and adds it to the gif frame.
            $pngCreator->createPng($_gameFieldController->getGameField(),$cycle);
            $gifCreator->addFrame(file_get_contents(__DIR__."/../../tmp/png/png".$cycle.".png"), 50);
            unlink(__DIR__."/../../tmp/png/png".$cycle.".png");
            $_gameFieldController->run();
        }

        file_put_contents(__DIR__."/../../tmp/gif/animation.gif", $gifCreator->getAnimation());
    }
}