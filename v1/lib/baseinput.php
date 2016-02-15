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
     * Class constructor
     * @param array $_config If a plugin needs specific values you can give an associative array as parameter which contains the necessary data.
     */
    abstract public function __construct(array $_config = NULL);

    /**
     * This function creates the gamefield.
     */
    abstract protected function createGamefield();

    /**
     * This function sets the cells alive for the first round.
     */
    abstract protected function setCells();

    /**
     * This function returns the gamefield.
     * @return GameField
     */
    abstract public function getGameField();


}