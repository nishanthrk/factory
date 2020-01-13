<?php
/**
 * Created by PhpStorm.
 * User: nishanth
 * Date: 14/11/19
 * Time: 11:33 PM
 */

namespace app\database;


class Database
{
    public function getOperationClass($db) : Operation
    {
        $class = null;
        switch ($db) {
            case 'mongo':
                $class = new MongoOperation();
                break;
            case 'mysql':
                $class = new MysqlOperation();
                break;
        }

        return $class;
    }

    public function insert($db, $data)
    {
        $className = $this->getOperationClass($db);
        $count = $className->input($data);
        return $count;
    }

    public function result($db) : array
    {
        $className = $this->getOperationClass($db);
        $result = $className->output();
        return $result;
    }

}