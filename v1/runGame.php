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
foreach (glob('lib/input/*.php') as $file) include( $file );

use Ulrichsg\Getopt;
$options = new Getopt(array(
    array('i','input',Getopt::REQUIRED_ARGUMENT,'Input type (for now only txt is implemented'),
    array('f','filepath',Getopt::OPTIONAL_ARGUMENT,'Path to txt file(only required if txt is choosen as input'),
    array('o','output',Getopt::REQUIRED_ARGUMENT,'Output in console, as png or gif'),
    array('c','numCycles',Getopt::REQUIRED_ARGUMENT, 'Number of rounds the game should play 1-*'),
    array('H', 'help', Getopt::NO_ARGUMENT)

));

$options->parse();

if ($options->getOption('input'))
{
    if ($options->getOption("filepath")) $config = array('filePath' => $options->getOption('filepath'));
    $inputClass = $options->getOption("input")."Input";
    $input = new $inputClass($config);

    if ($options->getOption("output"))
    {
        $outputClass = $options->getOption("output")."Output";
        $numCycles = $options->getOption('numCycles');

        if ($options->getOption("numCycles"))
        {
            $gameFieldController = new GameFieldController($input->getGameField());
            $output = new $outputClass();
            $output->output($gameFieldController, $numCycles);
        }
        else die("Please specify a number of cycles the game should be played");
    }
    else die("Please specify an output mode");
}
else die("Wrong input");