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
     *
     * @param GameField $_gameField The GameField for retrieving alive states of all cells for each round.
     * @param int $_cycle The current game cycle which is saved.
     */
    public function createPng($_gameField, $_cycle)
    {
        $gameField = $_gameField;
        $x = $gameField->getWidth();
        $y = $gameField->getHeight();

        $fieldPng = imagecreate($x*10,$y*10);
        imagecolorallocate($fieldPng, 243, 243, 243);
        imagesetthickness($fieldPng, 5);

        for($i=0; $i<$y; $i++)
        { // Make columns
            for($j=0; $j<$x; $j++)
            { // Make rows
                if($gameField->getCellByCoords($j,$i)->isAlive() == true)
                {
                    $x1 = $j * 10 - 2;
                    $x2 = $x1 + 10 - 2;
                    $y1 = $i * 10 - 2;
                    $y2 = $y1 + 10 - 2;
                    imagefilledrectangle($fieldPng, $x1, $y1, $x2, $y2, 25);
                }
            }
        }
        imagepng($fieldPng,__DIR__."/../tmp/png/png".$_cycle.".png");
        imagedestroy($fieldPng);
    }
}