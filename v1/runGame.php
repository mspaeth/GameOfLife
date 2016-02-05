<?php
/**
 * @file
 * @version 2.8
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

require_once "lib/gamefieldcontroller.php";
require_once "lib/gamefield.php";
require_once "lib/consoleOutput.php";
require "lib/external/vendor/autoload.php";



use Ulrichsg\Getopt;
$options = new Getopt\Getoptv2(array(
            new Getopt\Option('o','output',Getopt\Getoptv2::REQUIRED_ARGUMENT),
            new Getopt\Option('w','width',Getopt\Getoptv2::REQUIRED_ARGUMENT),
            new Getopt\Option('h','height',Getopt\Getoptv2::REQUIRED_ARGUMENT),
            new Getopt\Option('c','numCycles',Getopt\Getoptv2::REQUIRED_ARGUMENT),
            new Getopt\Option('t','type',Getopt\Getoptv2::REQUIRED_ARGUMENT)
));

$options->parse();


if ($options->getOption('w')) $x = $options->getOption('h');
else echo "Argument --width is missing\n";

if ($options->getOption('h')) $y = $options->getOption('h');
else echo "Argument --height is missing\n";

if (isset($x) && isset($y))
{
    $gameField = new GameField($x,$y);

    if($options->getOption('t')) {
        switch ($options->getOption('t'))
        {
            case "blinker":
                $gameField->getCellByCoords(3, 2)->life();
                $gameField->getCellByCoords(3, 3)->life();
                $gameField->getCellByCoords(3, 4)->life();
                break;

            case "glider":
                $gameField->getCellByCoords(2, 1)->life();
                $gameField->getCellByCoords(3, 2)->life();
                $gameField->getCellByCoords(3, 3)->life();
                $gameField->getCellByCoords(2, 3)->life();
                $gameField->getCellByCoords(1, 3)->life();
                break;

            case "lws":
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

            default:
                echo "Wrong type!\n";
        }

        if($options->getOption('o'))
        {
            if($options->getOption('c'))
            {
                $numCycles = $options->getOption('c');

                $gameFieldController = new GameFieldController($gameField);
                $output = new ConsoleOutput();
                $output->output($gameFieldController, $numCycles);
            }
            else echo "Missing --numCycles argument\n";
        }
        else echo "Missing --output argument\n";
    }
    else echo "Missing --type argument\n";
}

