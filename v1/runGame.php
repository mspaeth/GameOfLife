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
    array('i','input',Getopt::REQUIRED_ARGUMENT,'Specifys how the start gamefield should be read, "txt" for reading from txt file' ),
    array('f','filepath',Getopt::OPTIONAL_ARGUMENT,'Path to txt file(only required if txt is choosen as input'),
    array('o','output',Getopt::REQUIRED_ARGUMENT,'"console" for console output, "png" for output as png file, "gif" for output as .gif file.'),
    array('c','numCycles',Getopt::REQUIRED_ARGUMENT, 'Number of rounds the game should play 1-*'),
    array('h', 'help', Getopt::NO_ARGUMENT)

));

echo "test";
$options->parse();

if ($options->getOption("help"))
{
    $options->showHelp();
}
else
{
    if ($options->getOption('input'))
    {
        if ($options->getOption("filepath")) $config = array('filePath' => $options->getOption('filepath'));
        $inputClass = $options->getOption("input")."Input";
        $input = new $inputClass($config);

        $outputClass = $options->getOption("output")."Output";

        if ($options->getOption("numCycles"))
        {
            $numCycles = $options->getOption('numCycles');
            if ($options->getOption("output"))
            {
                $gameFieldController = new GameFieldController($input->getGameField());
                $output = new $outputClass();
                $output->output($gameFieldController, $numCycles);
            }
            else
            {
                $options->showHelp();
                die("Please specify an output mode, view help for more information!");
            }
        }
        else
        {
            $options->showHelp();
            die("Please specify a number of cycles the game should be played, view help for more information!");
        }
    }
    else
    {
        $options->showHelp();
        die("Please specify input mode, view help for more information!");
    }
}

