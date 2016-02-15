<?php
/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

require_once "lib/gamefieldcontroller.php";
require_once "lib/gamefield.php";
include_once("lib/external/vendor/autoload.php");

foreach (glob('lib/output/*.php') as $file) include( $file );

use Ulrichsg\Getopt;
$options = new Getopt(array(
            array('o','output',Getopt::REQUIRED_ARGUMENT,'Output in console, as png or gif'),
            array('w','width',Getopt::REQUIRED_ARGUMENT,'Length of x-axis of the gamefield 1-*'),
            array('h','height',Getopt::REQUIRED_ARGUMENT,'Length of the y-axis of the gamefield 1-*'),
            array('c','numCycles',Getopt::REQUIRED_ARGUMENT, 'Number of rounds the game should play 1-*'),
            array('t','type',Getopt::REQUIRED_ARGUMENT, 'Figure that should be set, blinker, glider, or lws'),
            array('H', 'help', Getopt::NO_ARGUMENT)

));

$options->parse();

if ($options->getOption('width')) $x = $options->getOption('h');
else echo "Argument --width is missing\n";

if ($options->getOption('height')) $y = $options->getOption('h');
else echo "Argument --height is missing\n";

if (isset($x) && isset($y))
{
    $gameField = new GameField($x,$y);

    if($options->getOption('type')) {

        switch ($options->getOption('type'))
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

        if($options->getOption('output'))
        {
            $outputClass = $options->getOption("output")."Output";
            if($options->getOption('numCycles'))
            {
                $numCycles = $options->getOption('numCycles');

                $gameFieldController = new GameFieldController($gameField);
                $output = new $outputClass();
                $output->output($gameFieldController, $numCycles);
            }
            else echo "Missing --numCycles argument\n";
        }
        else echo "Missing --output argument\n";
    }
    else echo "Missing --type argument\n";
}

if($options->getOption('help'))
{
    $options->showHelp();
}
