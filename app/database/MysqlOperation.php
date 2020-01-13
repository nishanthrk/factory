<?php
/**
 * Created by PhpStorm.
 * User: nishanth
 * Date: 14/11/19
 * Time: 11:28 PM
 */

namespace app\database;


use app\config\Mysql;

class MysqlOperation implements Operation
{
    private $mysql;

    public function __construct()
    {
        $db = Mysql::getInstance();
        $this->mysql = $db->getConnection();
    }

    public function input($array)
    {
        $query = 'INSERT INTO hotel (hotel_name, image, city, address, description, star, latitude, longitude) VALUES ';

        foreach ($array as $key => $value) {

            $query .= "('".html_entity_decode(str_replace("'", ' ', $value['hotel_name']), ENT_QUOTES, "UTF-8")."','"
                        .html_entity_decode($value['image'], ENT_QUOTES, "UTF-8")."','"
                .html_entity_decode(str_replace("'", ' ', $value['city']), ENT_QUOTES, "UTF-8")."','"
                .html_entity_decode(str_replace("'", ' ', $value['address']), ENT_QUOTES, "UTF-8")."','"
                .html_entity_decode(str_replace("'", ' ', $value['description']), ENT_QUOTES, "UTF-8")."','"
                .html_entity_decode($value['star'], ENT_QUOTES, "UTF-8")."','"
                .html_entity_decode($value['latitude'], ENT_QUOTES, "UTF-8")."','"
                        .html_entity_decode($value['longitude'], ENT_QUOTES, "UTF-8").
                "'),";
        }

        $query = substr_replace($query, '', -1);

        if ($this->mysql->query($query) === TRUE) {
            return true;
        } else {
            trigger_error($this->mysql->error, E_USER_ERROR);
        }
    }

    public function output() : array
    {
        $query = 'SELECT * FROM hotel';

        $result = $this->mysql->query($query);

        $data = [];
        if ($result->num_rows > 0) {
            while ($value = $result->fetch_assoc()) {
                $data[] = [
                    'hotel_name' => $value['hotel_name'],
                    'image' => $value['image'],
                    'city' => $value['city'],
                    'address' => $value['address'],
                    'description' => $value['description'],
                    'star' => $value['star'],
                    'latitude' => $value['latitude'],
                    'longitude' => $value['longitude']
                ];
            }
        }


        return $data;
    }
}