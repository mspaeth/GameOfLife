<?php

/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

require_once __DIR__."/../baseinput.php";
require_once __DIR__."/../gamefield.php";
require_once __DIR__."/../gamefieldcontroller.php";
/**
 * This class opens a txt file which contains the start gamefield and sets the necessary cells alive.
 * The path to the txt file is saved in the $config array.
 */
class TxtInput extends BaseInput
{
    private $file;

    /**
     * The constructor sets the config value which contains the filepath.
     * @param array|NULL $_config Contains the path to the txt file with the gamefield (Required).
     */
    public function __construct(array $_config = NULL)
    {
        if(isset($_config))
        {
            $this->file=$_config['filePath'];
            $linecount = 0;
            $handle = fopen($this->file, "r");
            while(!feof($handle))
            {
                $line = fgets($handle);
                if(empty($this->width)) $this->width = strlen($line)-2;
                $linecount++;
            }
            $this->height = $linecount-1;
            fclose($handle);
        }
        else die("Error can't find txt file, please use --filepath 'path to file'");
        $this->createGamefield();
    }


    /**
     * Creates the gamefield and calls setCells() to set the specified cells from the txt file alive.
     */
    public function createGamefield()
    {
        $this->gamefield = new GameField($this->width, $this->height);
        $this->setCells();
    }

    /**
     * Opens the txt file and sets every cell alive which is set to true(1).
     */
    public function setCells()
    {
        $handle = fopen($this->file, "r");

        for ($y=0; $y<$this->height; $y++)
        {
            $line = fgets($handle);
            for ($x=0; $x<$this->width; $x++)
            {
                if ($line[$x] == "1") $this->gamefield->getCellByCoords($x,$y)->life();
            }
        }

        fclose($handle);
    }

    /**
     * Returns the gamefield.
     * @return GameField The gamefield.
     */
    public function getGameField()
    {
        return $this->gamefield;
    }

}


