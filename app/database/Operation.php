<?php

namespace app\database;
/**
 * Created by PhpStorm.
 * User: nishanth
 * Date: 14/11/19
 * Time: 8:04 PM
 */
interface Operation
{
    function input($array);

    function output() : array;
}