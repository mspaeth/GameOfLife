<?php

/**
 * @file
 * @version 0.1
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

/**
 * This abstract class is the base class for the input plugins.
 * All input classes have to extend from this class.
 */
abstract class BaseInput
{
    protected $gamefield;
    protected $gamefieldController;
    protected $width;
    protected $height;

    /**
     * Class constructor which creates the gamefield and then sets the active cells.
     *
     * @param array $_config If a plugin needs specific values you can give an associative array as parameter which contains the necessary data.
     */
    public function __construct(array $_config = null)
    {
        $this->createGamefield();
        $this->setCells();
    }

    /**
     * Creates the gamefield and calls setCells() to set cells alive.
     */
    public function createGamefield()
    {
        $this->gamefield = new GameField($this->width, $this->height);
    }

    /**
     * This function needs to be implemented in every plugin which extends from this class.
     * This function sets cells alive.
     */
    abstract protected function setCells();

    /**
     * This function returns the gamefield.
     *
     * @return GameField
     */
    public function getGameField()
    {
        return $this->gamefield;
    }


}