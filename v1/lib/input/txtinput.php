<?php

/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

require_once __DIR__."/../baseinput.php";
require_once __DIR__."/../gamefield.php";

/**
 * This plugins reads a text file which contains the start gamefield of the GoL.
 * The gamefield in the txt should look something like this:
 *
 * 00000000
 * 00000000
 * 00010000
 * 00010000
 * 00010000
 *
 * 0 = dead cells
 * 1 = living cells
 *
 * To use this plugin, you have to call the runGame.php with --input Txt and --filePath 'Path to txt file' and also
 * specify the number of cycles with --numCycles and the output with --output.
 * Example:
 * runGame.php --input Txt --filepath D:\gamefield.txt --numCycles 10 --output Console
 */
class TxtInput extends BaseInput
{
    private $file;

    /**
     * The constructor opens the txt file and calls the parent constructor to create the gamefield and set the cells.
     *
     * @param array|null $_config Config array which should contain in this context at least the filepath to the txt file, which we need for creating a GameField.
     */
    public function __construct(array $_config = null)
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

            parent::__construct($_config);
        }
        else die("Error can't find txt file, please use --filepath 'path to file'");
    }

    /**
     * Opens the txt file and sets every cell alive which is set to true(1) in the file.
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

}


