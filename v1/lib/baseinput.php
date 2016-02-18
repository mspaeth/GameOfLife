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
     * This parent constructor MUST be called from every inherited class!
     *
     * @param array $_config If a plugin needs specific values you can give an associative array as parameter which contains the necessary data.
     */
    public function __construct(array $_config = null)
    {
        $this->createGamefield();
        $this->setCells();
    }

    /**
     * Creates the gamefield.
     */
    public function createGamefield()
    {
        $this->gamefield = new GameField($this->width, $this->height);
    }

    /**
     * The implemented function will set depending on their input the given cells alive.
     */
    abstract protected function setCells();

    /**
     * This function returns the gamefield.
     *
     * @return GameField The GameField created by the input plugin.
     */
    public function getGameField()
    {
        return $this->gamefield;
    }


}