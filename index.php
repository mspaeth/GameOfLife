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

echo "Wieviele Zeilen soll das Feld hoch sein?\n";
$y = stream_get_line(STDIN, 1024, PHP_EOL);
echo "Wieviele Spalten soll es Breit sein?\n";
$x = stream_get_line(STDIN, 1024, PHP_EOL);
echo "Wieviele Runden sollen gespielt werden?";
$cycle = stream_get_line(STDIN, 1024, PHP_EOL);

$cells = array();

// Make columns
for($i=0; $i<$y; $i++)
{
    // Make rows
    for($j=0; $j<$x; $j++)
    {
        $cell = new Cell($i,$j,0);
        $cells[] = $cell;
    }
}

$gameField = new GameField($cells);

echo "Wieviele lebende Zellen möchtest du setzen?";
$numCells = stream_get_line(STDIN, 1024, PHP_EOL);

for ($i = 0; $i<$numCells; $i++)
{
    echo "Welche Position auf der Y-Achse soll die Zelle haben?\n";
    $cellPositionY = stream_get_line(STDIN, 1024, PHP_EOL);
    echo "Welche Position auf der X-Achse soll die Zelle haben?\n";
    $cellPositionX = stream_get_line(STDIN, 1024, PHP_EOL);

    $gameField->getCellByCoords($cellPositionY, $cellPositionX)->isAlive = 1;

}


$gameFieldController = new GameFieldController($gameField);

for ($numCycles = 0; $numCycles<$cycle; $numCycles++)
{
    // Make columns
    for($i=0; $i<$y; $i++)
    {
        // Make rows
        for($j=0; $j<$x; $j++)
        {
            echo (string)$gameFieldController->getGameField()->getCellByCoords($i,$j)->isAlive;
        }
        echo "\n";
    }
    echo "---------------------\n";
    $gameFieldController->run();
}


