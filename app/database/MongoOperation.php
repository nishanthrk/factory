<?php
/**
 * Created by PhpStorm.
 * User: nishanth
 * Date: 14/11/19
 * Time: 11:28 PM
 */

namespace app\database;

use app\config\Mongo;

class MongoOperation implements Operation
{
    private $collection;

    public function __construct()
    {
        $db = Mongo::getInstance();
        $this->collection = $db->getConnection();
    }


    public function input($array)
    {
        $insertedCount = $this->collection->insertMany($array);
        return $insertedCount;
    }

    public function output() : array
    {
        $cursor = $this->collection->find();

        $result = [];
        foreach ($cursor as $document) {
            $result[] = [
                'hotel_name' => $document['hotel_name'],
                'image' => $document['image'],
                'city' => $document['city'],
                'address' => $document['address'],
                'description' => $document['description'],
                'star' => $document['star'],
                'latitude' => $document['latitude'],
                'longitude' => $document['longitude']
            ];
        }

        return $result;
    }
}