<p align="center">
    <h1 align="center">LE PHP TEST</h1>
    <br>
</p>

Requirement :
<ul>
    <li> php 7.0+
    <li> mongodb
    <li> mysql
</ul>

Execution Commands :

<ul>
    <li> Please update the mysql credential in app/config/Mysql.php
    <li> Execute Create table command
    <li> composer install
    <li> php -S localhost:8000 -t le-php-test/
</ul>


```    
CREATE TABLE IF NOT EXISTS `le`.`hotel` (
`id` INT NOT NULL AUTO_INCREMENT,
`hotel_name` VARCHAR(256) NOT NULL,
`image` VARCHAR(512) NOT NULL,
`city` VARCHAR(128) NOT NULL,
`address` VARCHAR(512) NOT NULL,
`description` TEXT NOT NULL,
`star` TINYINT(1) NOT NULL,
`latitude` DECIMAL(10,8) NOT NULL,
`longitude` DECIMAL(11,8) NOT NULL,
PRIMARY KEY (`id`));
```

DIRECTORY STRUCTURE
-------------------

```
app/                     application main folder
    config/                  API Response function and database with singleton pattern
    core/                    Request and response to handle API
    database/                Database with Operation with factory pattern
vendor/                  contains dependent 3rd-party packages
index.php                index page where it load the data and send the response
```


# Screenshots

![course dashboard](https://i.ibb.co/r7zbWQq/api-sample.png)

Note : For mongodb using open connnection