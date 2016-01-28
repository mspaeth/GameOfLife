<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 14.01.2016
 * Time: 10:11
 */
require_once "lib/gamefieldcontroller.php";
require_once "lib/cell.php";
require_once "lib/gamefield.php";
require_once "lib/GifCreator.php";

echo "Wieviele Spalten soll es Breit sein?\n";
$x = stream_get_line(STDIN, 1024, PHP_EOL);
echo "Wieviele Zeilen soll das Feld hoch sein?\n";
$y = stream_get_line(STDIN, 1024, PHP_EOL);
echo "Wieviele Runden sollen gespielt werden?";
$cycle = stream_get_line(STDIN, 1024, PHP_EOL);

$cells = array();

// Make columns
for($i=0; $i<$y; $i++)
{
    // Make rows
    for($j=0; $j<$x; $j++)
    {
        $cell = new Cell($j,$i,0);
        $cells[] = $cell;
    }
}


$gameField = new GameField($cells);

echo "Wieviele lebende Zellen möchtest du setzen?";
$numCells = stream_get_line(STDIN, 1024, PHP_EOL);

for ($i = 0; $i<$numCells; $i++)
{
    echo "Welche Position auf der X-Achse soll die Zelle haben?\n";
    $cellPositionX = stream_get_line(STDIN, 1024, PHP_EOL);
    echo "Welche Position auf der Y-Achse soll die Zelle haben?\n";
    $cellPositionY = stream_get_line(STDIN, 1024, PHP_EOL);

    $gameField->getCellByCoords($cellPositionX, $cellPositionY)->isAlive = 1;
}

$gameFieldController = new GameFieldController($gameField);


$gif = new GifCreator(0, 2, array(-1, -1, -1));

for ($numCycles = 0; $numCycles<$cycle; $numCycles++)
{
    $fieldPng = imagecreate($x*10,$y*10);
    imagecolorallocate ($fieldPng, 243, 243, 243 );
    imagesetthickness($fieldPng, 5);

    // Make columns
    for($i=0; $i<$y; $i++)
    {
        // Make rows
        for($j=0; $j<$x; $j++)
        {
            //echo (string)$gameFieldController->getGameField()->getCellByCoords($j,$i)->isAlive;
            if ($gameFieldController->getGameField()->getCellByCoords($j,$i)->isAlive == 1)
            {
                $x1 = $j*10-2;
                $x2 = $x1+10-2;
                $y1 = $i*10-2;
                $y2 = $y1+10-2;

                imagefilledrectangle($fieldPng , $x1 , $y1 , $x2 , $y2 , 25 );
            }
        }
        echo "\n";
    }
    echo "---------------------\n";

    imagepng($fieldPng,"testcyle".$numCycles.".png");
    $gif->addFrame(file_get_contents("testcyle".$numCycles."png"), 200);
    imagedestroy($fieldPng);
    $gameFieldController->run();
}

file_put_contents("test.gif", $gif->getAnimation());