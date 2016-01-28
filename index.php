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
require_once "lib/output.php";
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

echo "Bitte waehle:\n";
echo "0 fuer Blinker";
echo "1 fuer Gleiter";
echo "2 fuer Light Weight Spaceship";
echo "3 fuer eigene Zellen";
$choosedChar = stream_get_line(STDIN, 1024, PHP_EOL);

switch ($choosedChar)
{
    case 0:
        $gameField->getCellByCoords(3, 2)->isAlive = 1;
        $gameField->getCellByCoords(3, 3)->isAlive = 1;
        $gameField->getCellByCoords(3, 4)->isAlive = 1;
        break;

    case 1:
        $gameField->getCellByCoords(2, 1)->isAlive = 1;
        $gameField->getCellByCoords(3, 2)->isAlive = 1;
        $gameField->getCellByCoords(3, 3)->isAlive = 1;
        $gameField->getCellByCoords(2, 3)->isAlive = 1;
        $gameField->getCellByCoords(1, 3)->isAlive = 1;
        break;

    case 2:
        $gameField->getCellByCoords(1, 5)->isAlive = 1;
        $gameField->getCellByCoords(2, 4)->isAlive = 1;
        $gameField->getCellByCoords(3, 4)->isAlive = 1;
        $gameField->getCellByCoords(4, 4)->isAlive = 1;
        $gameField->getCellByCoords(5, 4)->isAlive = 1;
        $gameField->getCellByCoords(5, 5)->isAlive = 1;
        $gameField->getCellByCoords(5, 6)->isAlive = 1;
        $gameField->getCellByCoords(4, 7)->isAlive = 1;
        $gameField->getCellByCoords(1, 7)->isAlive = 1;
        break;

    case 3:
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
        break;

    default:
        die("Wrong option");

}

$gameFieldController = new GameFieldController($gameField);

echo "Bitte wähle 0 für Konsolenoutput\n";
echo "Bitte wähle 1 für das Speichern jeder Runde als PNG\n";
echo "Bitte wähle 2 für das Speichern als GIF Animation\n";
$mode = stream_get_line(STDIN, 1024, PHP_EOL);

$game = new output($x,$y,$gameFieldController);
$game->runGame($cycle,$mode);