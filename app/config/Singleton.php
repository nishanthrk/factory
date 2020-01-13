<?php
/**
 * Created by PhpStorm.
 * User: nishanth
 * Date: 14/11/19
 * Time: 8:36 PM
 */

namespace app\config;


interface Singleton
{

    public static function getInstance();

    public function getConnection();
}