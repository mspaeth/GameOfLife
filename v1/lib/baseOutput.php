<?php
/**
 * @file
 * @version 2.8
 * @copyright 2016 CN-Consult GmbH
 * @author Max Späth <max.spaeth@cn-consult.eu>
 */

/**
 * This abstract class is the baseClass for the output plugins.
 * All output classes have to extend from this class.
 */
abstract class BaseOutput
{
    /**
     * This function needs to be implemented in every plugin which extends from this class
     * It gets the necessary parameters to output the gamefield.
     *
     * @param GameFieldController $_gameFieldController The gamefieldcontroller which contains the gamefield.
     * @param int $_numCycles The amount of rounds the game should be played.
     */
    abstract public function output(GameFieldController $_gameFieldController, $_numCycles);
}