<?php
require __DIR__ . '/vendor/autoload.php';


use app\core\{Request, Router};
use app\config\{ApiResponse};
use app\database\Database;

$router = new Router(new Request);

$router->get('/', function() {

    $params = (new Request())->getBody();

    if (empty($params['database'])) {
        (new ApiResponse())->unprocessableEntity(-1, 'Database cannot be blank');
    }

    if (!in_array($params['database'], ['mysql', 'mongo'])) {
        (new ApiResponse())->unprocessableEntity(-1, 'Database can consist only mysql|mongo');
    }

    $file = fopen('hotels.csv', "r");

    $data = [];
    $i = 0;
    while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
        if ($i != 0) {
            $data[] = [
                'hotel_name' => $column[0],
                'image' => $column[1],
                'city' => $column[2],
                'address' => $column[3],
                'description' => $column[4],
                'star' => $column[5],
                'latitude' => $column[6],
                'longitude' => $column[7]
            ];
        }
        $i++;
    }

    if (empty(array_values($data))) {
        (new ApiResponse())->noContent();
    }

    $database = new Database();

    $database->insert($params['database'], array_values($data));

    $result = $database->result($params['database']);

    (new ApiResponse())->ok(1, ['hotels' => array_values($result)]);
});