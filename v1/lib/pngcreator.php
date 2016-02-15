<?php

/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

/**
 * This class creates and saves the gamefield each round as a png file.
 */
class pngCreator
{
    /**
     * Creates the png and saves it to lib/output/png.
     * @param GameFieldController $_gameFieldController The GameFieldController for calculating alive states of all cells for each round.
     * @param int $_numCycles Amount of rounds the game should be played.
     */
    public function createPng($_gameFieldController, $_numCycles)
    {
        $numCycles = $_numCycles;
        $gameFieldController = $_gameFieldController;
        $x = $gameFieldController->getGameField()->getWidth();
        $y = $gameFieldController->getGameField()->getHeight();

        for ($cycle = 0; $cycle<$numCycles; $cycle++)
        { // Amount of cycles
            $fieldPng = imagecreate($x*10,$y*10);
            imagecolorallocate($fieldPng, 243, 243, 243);
            imagesetthickness($fieldPng, 5);
            
            for($i=0; $i<$y; $i++)
            { // Make columns
                for($j=0; $j<$x; $j++)
                { // Make rows
                    $x1 = $j*10-2;
                    $x2 = $x1+10-2;
                    $y1 = $i*10-2;
                    $y2 = $y1+10-2;
                    imagefilledrectangle($fieldPng , $x1 , $y1 , $x2 , $y2 , 25 );
                }
            }
            imagepng($fieldPng,__DIR__."/png/cycle".$numCycles.".png");
            imagedestroy($fieldPng);
            $gameFieldController->run();
        }
    }
}