<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28.01.2016
 * Time: 12:34
 */
class output
{
    private $x;
    private $y;
    private $gameFieldController;

    public function __construct($widthX, $heightY, $gameFieldController)
    {
        $this->x = $widthX;
        $this->y = $heightY;
        $this->gameFieldController = $gameFieldController;
    }

    /**
     * This function handles the output of the game
     *
     * @param $cycle int Number of cycles the game should go.
     * @param $mode int 0=Console 1=PNG 2=GIF
     */
    public function runGame($_cycle, $_mode)
    {
        $cycle = $_cycle;
        $mode = $_mode;

        if($mode==2)    $gif = new GifCreator(0, 2, array(-1, -1, -1));

        for ($numCycles = 0; $numCycles<$cycle; $numCycles++)
        {
            if($mode==1 || $mode == 2)
            {
                $fieldPng = imagecreate($this->x*10,$this->y*10);
                imagecolorallocate($fieldPng, 243, 243, 243);
                imagesetthickness($fieldPng, 5);
            }

            // Make columns
            for($i=0; $i<$this->y; $i++)
            {
                // Make rows
                for($j=0; $j<$this->x; $j++)
                {
                    if($mode==0) echo (string)$this->gameFieldController->getGameField()->getCellByCoords($j,$i)->isAlive;
                    if(($mode==1 || $mode==2) && $this->gameFieldController->getGameField()->getCellByCoords($j,$i)->isAlive == 1)
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
            if($mode==0)  echo "---------------------\n";

            if($mode==1 || $mode==2)    imagepng($fieldPng,"testcyle".$numCycles.".png");
            if($mode==2)
            {
                $gif->addFrame(file_get_contents("testcyle".$numCycles.".png"), 200);
                unlink("testcyle".$numCycles.".png");
            }
            if($mode==1 || $mode==2)    imagedestroy($fieldPng);
            $this->gameFieldController->run();
        }
        if($mode==2)  file_put_contents("test.gif", $gif->getAnimation());
    }
}