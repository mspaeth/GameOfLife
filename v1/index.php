<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 14.01.2016
 * Time: 10:11
 */
require_once "lib/gamefieldcontroller.php";
require_once "lib/gamefield.php";
require_once "lib/output.php";
require_once "lib/GifCreator.php";
require __DIR__ . '../vendor/autoload.php';


echo "Wieviele Spalten soll es Breit sein?\n";
$x = stream_get_line(STDIN, 1024, PHP_EOL);
echo "Wieviele Zeilen soll das Feld hoch sein?\n";
$y = stream_get_line(STDIN, 1024, PHP_EOL);
echo "Wieviele Runden sollen gespielt werden?";
$cycle = stream_get_line(STDIN, 1024, PHP_EOL);


$gameField = new GameField($x,$y);

echo "Bitte waehle:\n";
echo "0 fuer Blinker";
echo "1 fuer Gleiter";
echo "2 fuer Light Weight Spaceship";
echo "3 fuer eigene Zellen";
$choosedChar = stream_get_line(STDIN, 1024, PHP_EOL);

switch ($choosedChar)
{
    case 0:
        $gameField->getCellByCoords(3, 2)->life();
        $gameField->getCellByCoords(3, 3)->life();
        $gameField->getCellByCoords(3, 4)->life();
        break;

    case 1:
        $gameField->getCellByCoords(2, 1)->life();
        $gameField->getCellByCoords(3, 2)->life();
        $gameField->getCellByCoords(3, 3)->life();
        $gameField->getCellByCoords(2, 3)->life();
        $gameField->getCellByCoords(1, 3)->life();
        break;

    case 2:
        $gameField->getCellByCoords(1, 5)->life();
        $gameField->getCellByCoords(2, 4)->life();
        $gameField->getCellByCoords(3, 4)->life();
        $gameField->getCellByCoords(4, 4)->life();
        $gameField->getCellByCoords(5, 4)->life();
        $gameField->getCellByCoords(5, 5)->life();
        $gameField->getCellByCoords(5, 6)->life();
        $gameField->getCellByCoords(4, 7)->life();
        $gameField->getCellByCoords(1, 7)->life();
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
            $gameField->getCellByCoords($cellPositionX, $cellPositionY)->life();
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