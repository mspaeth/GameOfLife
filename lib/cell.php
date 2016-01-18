<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 15.01.2016
 * Time: 12:01
 */
class Cell
{
    private $y;
    private $x;

    public $isAlive;

    public function __construct($_y, $_x, $_isAlive)
    {
        $this->y = $_y;
        $this->x = $_x;
        $this->isAlive = $_isAlive;
    }

    public function getCoordY()
    {
        return $this->y;
    }

    public function getCoordX()
    {
        return $this->x;
    }
}